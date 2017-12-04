<?php
session_start();
include("connect.inc");
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
<title>Untitled Document</title>
<style>
	.font_title{font-family:"Angsana New"; font-size:36px;}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F;}

.tb_font_2 {
	color: #360;
	font-weight: bold;
}
.style5 {color: #000099; font-weight: bold; }
.style6 {color: #F4224D; font-weight: bold; }
.profile {
	font-family: "TH SarabunPSK";
	color: #360;
	font-size: 18px;
	font-weight: bold;
}
.profilevalue {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.profilehead {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: #360;
	font-weight: bold;
}
.profileheadvalue {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	font-weight: bold;
}
.labfont {
	font-size: 20px;
}
.sum {
	font-family:"Angsana New";
	font-size: 28px;
	color: #360;
}
.sum2 {
	color: #F00;
}
.sum1 {
	color: #00F;
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

<body bgcolor="#CDF1FC">
<a href ="../nindex.htm" >&lt;&lt; ����</a>
<center><div class="font_title">�������Ǩ�آ�Ҿ��Шӻ�</div></center>

<form action="dxdr_ofyear.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
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

$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$arr_view["hn"];
$date_vn = date("Y-m-d").$arr_view["vn"];

$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);


$sqlvn = "Select vn From dxofyear  where  hn = '".$_POST["p_hn"]."' limit 0,1";
list($vn) = mysql_fetch_row(mysql_query($sqlvn));

//�����ѹ�Դ�ҡ opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

//���Ҽš�õ�Ǩ�ҧ��Ҹ� ****************************************************************************************

	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54')  Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54' ) Order by labcode ASC ";
	
	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC ";
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
		$sql = "Select drugreact,congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($drugreact,$congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0) = Mysql_fetch_row($result);
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
<FORM METHOD=POST ACTION="dxdr_ofyear_save.php" target="_blank" <?php if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('�������ѧ�����ӡ��ŧ����¹');return false;\"";}?>>

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view["vn"];?>" />
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  width="100%">
<tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CDF1FC" >
    <tr>
      <td align="left" bgcolor="#0033FF" class="tb_font_1" colspan="12">&nbsp;&nbsp;&nbsp;�����ż�����</td>
    </tr>
    <tr>
      <td align="left" class="profilehead">VN</td>
      <td align="left" class="profilehead"> :</td>
      <td  class="profileheadvalue"><?php echo $arr_view["vn"];?></td>
      <td rowspan="2" align="left" class="profilehead">����-ʡ�� </td>
      <td rowspan="2" align="left" class="profilehead">:</td>
      <td rowspan="2" class="profileheadvalue"><?php echo $arr_view["ptname"];?></td>
      <td rowspan="2" align="left" class="profilehead">�ѧ�Ѵ </td>
      <td rowspan="2" align="left" class="profilehead">:</td>
      <td rowspan="2" class="profileheadvalue"><?php echo $arr_view["camp"];?></td>
      <input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/>
      <td width="89" rowspan="2" align="left" class="profilehead">����</td>
      <td width="4" rowspan="2" align="left" class="profilehead">:</td>
      <td width="221" rowspan="2" class="profileheadvalue"><?php echo $arr_view["age"];?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">HN </td>
      <td align="left" class="profilehead">:</td>
      <td class="profileheadvalue"><?php echo $arr_view["hn"];?></td>
    </tr>
    <tr>
      <td align="left" class="profile">��ǹ�٧ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $height; ?> ��.</td>
      <td align="left" class="profile">���˹ѡ</td>
      <td align="left" class="profile">:</td>
      <td align="left" class="profilevalue"><?php echo $weight; ?> ��. </td>
      <td align="left" class="profile">�ͺ��� </td>
      <td align="left" class="profile">:</td>
      <?
			$ht = $height/100;
            $bmi = number_format($weight/($ht*$ht),2);
			?>
      <td class="profilevalue"><?php echo $arr_dxofyear["round_"]; ?> ��.</td>
      <td align="left" class="profile">BMI</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $bmi; ?></td>
    </tr>
    <tr>
      <td align="left" class="profile">T </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $arr_dxofyear["temperature"]; ?> C&deg;</td>
      <td align="left" class="profile">P </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $arr_dxofyear["pause"]; ?> ����/�ҷ�</td>
      <td align="left" class="profile">R </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $arr_dxofyear["rate"]; ?> ����/�ҷ�</td>
      <td align="left" class="profile">BP </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $arr_dxofyear["bp1"]; ?> / <?php echo $arr_dxofyear["bp2"]; ?> mmHg</td>
    </tr>
    <tr>
      <td align="left" class="profile">������ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><? if($arr_dxofyear['cigarette']=="1") echo "�ٺ"; else echo "����ٺ";?></td>
      <td align="left" class="profile">����</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><? if($arr_dxofyear['alcohol']=="1") echo "����"; else echo "������";?></td>
      <td align="left" class="profile">����</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><? if($arr_dxofyear['drugreact']=="0"|$drugreact=="0") echo "�������"; else echo $arr_dxofyear['drugreact']; ?>
        &nbsp;<?php echo $txt_react2;?></td>
      <td align="left" class="profile">�ä��Шӵ��</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?php echo $congenital_disease;?></td>
    </tr>
    <tr>
      <td align="left" class="profile">�ҡ�� </td>
      <td align="left" class="profile">:</td>
      <td colspan="4" class="profilevalue"><?php echo $arr_dxofyear['organ'];?></td>
      <td align="left" class="profile">ᾷ�� </td>
      <td align="left" class="profile">:</td>
      <td colspan="4" class="profilevalue"><?php 
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
  </table></td></tr>
</table>
<BR>

<!-- �š�õ�Ǩ�ҧ��Ҹ� -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  width="100%">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" bgcolor="#9EE3F8"  width="100%">
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#0033FF">&nbsp;&nbsp;&nbsp;�š�õ�Ǩ�ҧ��Ҹ� ������ѹ��� <?php echo $lab_date;?></TD>
	</TR>
	<TR class="tb_font">
		<TD bgcolor="#CDF1FC">
	&nbsp;&nbsp; <span class="style5">UA :</span> 
       <table width="100%" border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult,$unit,$normalrange,$flag) = mysql_fetch_row($result_ua)){
		if($labname == "OTHERU"){
			$size="13";
		}else{
			$size="6";
		}

		if(!empty($arr_dxofyear[$list_ua[$labname]]))
			$labresult = $arr_dxofyear[$list_ua[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<?php  if($flag!="N")  echo "<span class='style6'>".$labresult."</span>"; else echo $labresult;?></td>
	<?php 
 	if($i=="21") echo "<td colspan='2' align='center'><input name='normal' type='radio' value='����' onclick=\"togglediv2('acnormal')\" />�Ż��� <input name='normal' type='radio' value='�Դ����' onclick=\"togglediv1('acnormal')\" />�Դ���� </td><td colspan='6'><div id=\"acnormal\" style='display: none;'><select name='ch'><option value='��������ʹᴧ㹻������'>��������ʹᴧ㹻������</option><option value='��������ʹ���㹻������'>��������ʹ���㹻������</option><option value='�õչ����㹻������'>�õչ����㹻������</option><option value='��ӵ������㹻������'>��ӵ������㹻������</option><option value='��������ʹᴧ㹻������,��������ʹ���㹻������'>��������ʹᴧ㹻������,��������ʹ���㹻������</option><option value='��������ʹᴧ㹻������,��������ʹ���㹻������'>��������ʹᴧ㹻������,�õչ����㹻������</option><option value='��������ʹᴧ㹻������,��ӵ������㹻������'>��������ʹᴧ㹻������,��ӵ������㹻������</option><option value='��������ʹᴧ㹻������,��ӵ������㹻������'>��������ʹ���㹻������,�õչ����㹻������</option><option value='��������ʹ���㹻������,��ӵ������㹻������'>��������ʹ���㹻������,��ӵ������㹻������</option><option value='�õչ����㹻������,��ӵ������㹻������'>�õչ����㹻������,��ӵ������㹻������</option><option value='��������ʹᴧ㹻������,��������ʹ���㹻������,�õչ����㹻������'>��������ʹᴧ㹻������,��������ʹ���㹻������,�õչ����㹻������</option><option value='��������ʹᴧ㹻������,��������ʹ���㹻������,��ӵ������㹻������'>��������ʹᴧ㹻������,��������ʹ���㹻������,��ӵ������㹻������</option><option value='��������ʹ���㹻������,�õչ����㹻������,��ӵ������㹻������'>��������ʹ���㹻������,�õչ����㹻������,��ӵ������㹻������</option><option value='��������ʹᴧ㹻������,��������ʹ���㹻������,�õչ����㹻������,��ӵ������㹻������'>��������ʹᴧ㹻������,��������ʹ���㹻������,�õչ����㹻������,��ӵ������㹻������</option></select></div></td>";
	if($i%5==0) echo "<tr></tr>";
	$i++;
	
			}?>
		  </tr>
      </table>
	  <hr />
	  &nbsp;&nbsp; <span class="style5">CBC :</span> 
	<table width="100%" border="0">
	  
	  <?php
	  //$i=1;
	  $lab_cbcvalue = array();
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
		}*/
		}

		/*if(!empty($arr_dxofyear[$list_cbc[$labname]]))
			$labresult = $arr_dxofyear[$list_cbc[$labname]];*/
	  ?>
          <tr>
          <td width="68" align="right" class="tb_font_2">ATYP :</td>
          <td width="54">&nbsp;<?php echo $lab_cbcvalue[0];?></td>
          <td width="65" align="right" class="tb_font_2">BAND :</td>
          <td width="54">&nbsp;<?php echo $lab_cbcvalue[1];?></td>
          <td width="83" align="right" class="tb_font_2">BASO :</td>
          <td width="52">&nbsp;<?php echo $lab_cbcvalue[2];?></td>
          <td width="71" align="right" class="tb_font_2">EOS : </td>
          <td width="54">&nbsp;<?php echo $lab_cbcvalue[3];?></td>
          <td width="99" align="right" class="tb_font_2">HB :</td>
          <td width="89">&nbsp;<?php echo $lab_cbcvalue[4];?></td>
		  </tr>
          <tr>
            <td align="right" class="tb_font_2">LYMP : </td>
            <td>&nbsp;<?php echo $lab_cbcvalue[6];?></td>
            <td align="right" class="tb_font_2">MCH :</td>
            <td>&nbsp;<?php echo $lab_cbcvalue[7];?></td>
            <td align="right" class="tb_font_2">MCHC : </td>
            <td>&nbsp;<?php echo $lab_cbcvalue[8];?></td>
            <td align="right" class="tb_font_2">MCV :</td>
            <td>&nbsp;<?php echo $lab_cbcvalue[9];?></td>
            <td align="right" class="tb_font_2">MONO : </td>
            <td>&nbsp;<?php echo $lab_cbcvalue[10];?></td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2">NEU : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[11];?></td>
          <td align="right" class="tb_font_2">NRBC : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[12];?></td>
          <td align="right" class="tb_font_2">OTHER : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[13];?></td>
          <td align="right" class="tb_font_2">RBC : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[16];?></td>
          <td align="right" class="tb_font_2">RBCMOR : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[17];?></td>
		  </tr>
          <tr>
            <td align="right" class="tb_font_2">PLTS :</td>
          <td>&nbsp;<?php echo $lab_cbcvalue[15];?></td>
            <td colspan="8" align="right" class="tb_font_2">&nbsp;</td>
            </tr>
          <tr>
          <td align="right" class="tb_font_2">HCT : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[5];?></td>
          <td align="left" class="labfont" >(<?=$lab_cbcrange[5]?>)</td>
          <td align="center" class="labfont" ><?=$lab_cbcflag[5]?></td>
          <td colspan="2"><input name='normal31' type='radio' value='����' onclick="togglediv2('acnormal31')" <? if($lab_cbcflag[5]=="N") echo "checked";?> />�Ż��� <input name='normal31' type='radio' value='�Դ����' onclick="togglediv1('acnormal31')" <? if($lab_cbcflag[5]!="N") echo "checked";?>/>�Դ���� </td><td colspan="4"><div id="acnormal31" <? if($lab_cbcflag[5]=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch31'><option value='��ӡ��һ���' <? if($lab_cbcflag[5]=="L") echo "selected"; ?>>��ӡ��һ��� ��ᾷ�����͵�Ǩ�����˵�</option><option value='�٧���һ���' <? if($lab_cbcflag[5]=="H") echo "selected"; ?>>�٧���һ��� ��ᾷ�����͵�Ǩ�����˵�</option></select></div></td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2">WBC : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[18];?></td>
          <td align="left" class="labfont" >(<?=$lab_cbcrange[18]?>)</td>
          <td align="center" class="labfont" ><?=$lab_cbcflag[18]?></td>
          <td colspan="2"><input name='normal32' type='radio' value='����' onclick="togglediv2('acnormal32')" <? if($lab_cbcflag[18]=="N") echo "checked";?> />�Ż��� <input name='normal32' type='radio' value='�Դ����' onclick="togglediv1('acnormal32')" <? if($lab_cbcflag[18]!="N") echo "checked";?>/>�Դ���� </td><td colspan="4"><div id="acnormal32" <? if($lab_cbcflag[18]=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> >
            <select name='ch32'>
              <option value='������ʹ��ǵ�ӡ���ࡳ��' <? if($lab_cbcflag[18]=="L") echo "selected"; ?>>������ʹ��ǵ�� ��ᾷ�����͵�Ǩ�����˵�</option>
              <option value='������ʹ����٧����ࡳ��' <? if($lab_cbcflag[18]=="H") echo "selected"; ?>>������ʹ����٧ ��ᾷ�����͵�Ǩ�����˵�</option>
            </select>
          </div></td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2">PLTC : </td>
          <td>&nbsp;<?php echo $lab_cbcvalue[14];?></td>
          <td align="left" class="labfont" >(<?=$lab_cbcrange[14]?>)</td>
          <td align="center" class="labfont" ><?=$lab_cbcflag[14]?></td>
          <td colspan="2"><input name='normal33' type='radio' value='����' onclick="togglediv2('acnormal33')" <? if($lab_cbcflag[14]=="N") echo "checked";?> />�Ż��� <input name='normal33' type='radio' value='�Դ����' onclick="togglediv1('acnormal33')" <? if($lab_cbcflag[14]!="N") echo "checked";?>/>�Դ���� </td><td colspan="4"><div id="acnormal33" <? if($lab_cbcflag[14]=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> >	<select name='ch33'>
	  <option value='������ʹ���' <? if($lab_cbcflag[14]=="L") echo "selected"; ?>>������ʹ��� ��ᾷ�����͵�Ǩ�����˵�</option>
      <option value='������ʹ�٧' <? if($lab_cbcflag[14]=="H") echo "selected"; ?>>������ʹ�٧ ��ᾷ�����͵�Ǩ�����˵�</option>
	  </select></div></td>
          </tr>
          <?
	  }
		  ?>
      </table>

<hr />
	  <table width="100%" border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange, $flag) = mysql_fetch_row($result_lab)){

			if(!empty($arr_dxofyear[$list_lab[$labname]]))
			$labresult = $arr_dxofyear[$list_lab[$labname]];

	  ?>
          <td width="65" align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td width="40">&nbsp;<?php echo $labresult;?></td>
			<td width="80" class="labfont">(<? echo $normalrange?>)</td>
            <td width="50" align="center" class="labfont"><? echo $flag?></td>
			<td width="154"><input name='normal<?=$i?>' type='radio' value='����' onclick="togglediv2('acnormal<?=$i?>');" <? if($flag=="N") echo "checked";?> />�Ż��� <input name='normal<?=$i?>' type='radio' value='�Դ����' onclick="togglediv1('acnormal<?=$i?>');" <? if($flag!="N") echo "checked";?>/>�Դ���� </td>
            <td colspan="4">
           <? if($labname=="ALP"){?>
           <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> >
			<select name='ch<?=$i?>'>
			  <option value='��þ�ᾷ�����͵�Ǩ�����˵�'>��þ�ᾷ�����͵�Ǩ�����˵�</option>
			  </select>
			</div>
            <?
		   }elseif($labname=="ALT"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='ʧ��������еѺ�ѡ�ʺ ��ᾷ�����������˵�'>ʧ��������еѺ�ѡ�ʺ</option></select></div>
            <?
		   }elseif($labname=="AST"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='ʧ��������еѺ�ѡ�ʺ ��ᾷ�����������˵�'>ʧ��������еѺ�ѡ�ʺ</option></select></div>
            <?
		   }elseif($labname=="BUN"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='ʧ���˹�ҷ���÷ӧҹ�ͧ䵵�ӡ��һ��� ��õ�Ǩ�Ҥ����Դ���Ԣͧ����������ҧ��� ��ᾷ�����͵�Ǩ�����˵�' <? if($flag=="H") echo "selected";?>>ʧ���˹�ҷ���÷ӧҹ�ͧ䵵�ӡ��һ��� ��õ�Ǩ�Ҥ����Դ���Ԣͧ����������ҧ���</option></select></div>
            <?
		   }elseif($labname=="CHOL"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='���дѺ��ѹ�٧ ��駴�ҹ�ͧ�ʹ��ᴧ ����÷��� ��ᾷ�����͵�Ǩ�����˵�' <? if($flag=="H") echo "selected";?>>���дѺ��ѹ�٧ ��駴�ҹ�ͧ�ʹ��ᴧ ����÷���</option></select></div>
            <?
		   }elseif($labname=="CREA"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='ʧ���˹�ҷ���÷ӧҹ�ͧ䵵�ӡ��һ��� ��õ�Ǩ�Ҥ����Դ���Ԣͧ����������ҧ��� ��ᾷ�����͵�Ǩ�����˵�' <? if($flag=="H") echo "selected";?>>ʧ���˹�ҷ���÷ӧҹ�ͧ䵵�ӡ��һ��� ��õ�Ǩ�Ҥ����Դ���Ԣͧ����������ҧ���</option></select></div>
            <?
		   }elseif($labname=="GLU"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='�дѺ��ӵ������ʹ�٧ ʧ������ä����ҹ ��ᾷ�����͵�Ǩ�����˵�' <? if($flag=="H") echo "selected";?>>�дѺ��ӵ������ʹ�٧ ʧ������ä����ҹ</option></select></div>
            <?
		   }elseif($labname=="TRIG"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='���ҹ����èӾǡ��,��ӵ��,����ͧ�����ֹ��� ��ᾷ�����͵�Ǩ�����˵�' <? if($flag=="H") echo "selected";?>>���ҹ����èӾǡ��,��ӵ��,����ͧ�����ֹ���</option></select></div>
            <?
		   }elseif($labname=="URIC"){
			?>
            <div id="acnormal<?=$i?>" <? if($flag=="N") echo "style='display: none;'"; else "style='display: block;'"; ?> ><select name='ch<?=$i?>'><option value='�����Сô���ԡ����ʹ�٧���һ��� ��ᾷ�����͵�Ǩ�����˵�' <? if($flag=="H") echo "selected"; ?>>�����Сô���ԡ����ʹ�٧���һ���</option></select></div>
            <?
		   }
			?>
            </td>
            </tr>
	<?php 
	$i++;
			}?>
            </table>
            <hr />
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" width="100%" >
<TR>
	<TD><table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr>
	    <td align="left" class="tb_font_1" bgcolor="#0033FF" colspan="10">&nbsp;&nbsp;&nbsp;��õ�Ǩ��� �</td>
	    </tr>
	  <tr>
	    <td width="20%" align="right" class="tb_font_2">��Ǩ��ҧ��·���� : </td>
	    <td width="17%"><input name='normal21' type='radio' value='����' onclick="togglediv2('acnormal21')"/>
	      �Ż���
	      <input name='normal21' type='radio' value='�Դ����' onclick="togglediv1('acnormal21')"/>
	      �Դ���� </td>
	    <td colspan="3"><div id="acnormal21" style='display: none;'>
	     <input name="ch21" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ��硫�����ʹ : </td>
	    <td><input name='normal22' type='radio' value='����' onclick="togglediv2('acnormal22')"/>
	      �Ż���
	      <input name='normal22' type='radio' value='�Դ����' onclick="togglediv1('acnormal22')"/>
	      �Դ���� </td>
	    <td colspan="3"><div id="acnormal22" style='display: none;'>
	      <input name="ch22" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ����移ҡ���١ : </td>
	    <td><input name='normal23' type='radio' value='����' onclick="togglediv2('acnormal23')"/>
	      �Ż���
	      <input name='normal23' type='radio' value='�Դ����' onclick="togglediv1('acnormal23')"/>
	      �Դ���� </td>
	    <td colspan="3"><div id="acnormal23" style='display: none;'>
	      <input name="ch23" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ��������� :</td>
	    <td><input name="other1" type="text" size="20" /></td>
	    <td colspan="2"><input name='normal24' type='radio' value='����' onclick="togglediv2('acnormal24')"/>
�Ż���
  <input name='normal24' type='radio' value='�Դ����' onclick="togglediv1('acnormal24')"/>
�Դ���� </td>
	    <td width="45%"><div id="acnormal24" style='display: none;'>
	      <input name="ch24" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ��������� :</td>
	    <td><input name="other2" type="text" size="20" /></td>
	    <td colspan="2"><input name='normal25' type='radio' value='����' onclick="togglediv2('acnormal25')"/>
�Ż���
  <input name='normal25' type='radio' value='�Դ����' onclick="togglediv1('acnormal25')"/>
�Դ���� </td>
	    <td><div id="acnormal25" style='display: none;'>
	      <input name="ch25" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
	  </table></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>
<TABLE width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  >
 <tr>
	    <td height="49" align="center" class="sum"><strong>��ػ�š�õ�Ǩ</strong> :
<input name='normal26' type='radio' value='����'/>
	      <span class="sum1">����</span>
	      <input name='normal26' type='radio' value='�Դ���� ��þ�ᾷ�����������˵�' />
	      <span class="sum2">�Դ����</span></td>
	    </tr>
</TABLE>
<BR>
<!-- �ѹ�֡����Թԩ�¨ҡᾷ�� -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" bgcolor="#9EE3F8">
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#0033FF">&nbsp;&nbsp;&nbsp;�ѹ�֡����Թԩ�¨ҡᾷ��</TD>
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
<input name="submit" type="submit" value="��ŧ"  />&nbsp;&nbsp;
<input name="submit2" type="submit" value="��ŧ&amp;ʵԡ���� OPD" />
</center>
<INPUT TYPE="hidden" value="<?php echo $bmi;?>" name="bmi" />
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
</FORM>






<?php }?>



<?php 
include("unconnect.inc");
 ?>
</body>


</html>
