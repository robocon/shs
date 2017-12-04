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
<a href ="../nindex.htm" >&lt;&lt; ����</a>
<center>
  <div class="font_title">�������Ǩ�آ�Ҿ��Шӻ�Ẻ�����</div></center>

<form action="dx_ofyear_group_con.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">��͡�����Ţ HN , ����-ʡ��</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/><input type="submit" name="Submit1" value="��ŧ" /></TD>
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

<?
if(isset($_POST['Submit1'])){
?>

<!-- ���������ͧ�鹢ͧ������ -->
<FORM METHOD=POST ACTION="dx_ofyear_save_group_con.php" target="_blank">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view1["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view["vn"];?>" />
<?
if(isset($_POST['Submit1'])){
	$sql = "select * from predxofyear where hn= '".$_POST['p_hn']."' and camp = 'MX01�SCG' and thidate != '0000-00-00 00:00:00' limit 1";
	$row = mysql_query($sql);
	$numquery = mysql_num_rows($row);
	if($numquery=="0"){
		echo "����բ����š�õ�Ǩ";
	}
	else{
		$query = mysql_fetch_array($row);
	}
}

if($numquery!="0"){

$pic = explode("-",$query['company']);
$ban = explode(" ",$query['type_check']);

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
    	<td align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">Ẻ��õ�Ǩ�آ�Ҿ    	  
   	    <?=$pic[1]?></span></span></strong></td>
        <td width="163" rowspan="3" align="center" valign="top"><img src="images/<?=$pic[0]?>.jpg" width="120" height="75" /></td>
    </tr>
    <tr>
      <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
    <tr>
      <td align="center" class="pdxhead">��Ǩ������ѹ���...<?=$query['thidate']?>...</td>
      </tr>
      </table>
<br />
      <table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td width="718" class="pdxpro">HN :
        <strong>
        <?=$query['hn']?>
        </strong>       ����-ʡ�� : 
      <strong><?=$query['ptname']?></strong>
      <? $age1 = calcage($query1['dbirth']);?>
      ���� <?=$age1?> �Ţ�ѵû�� : <?=$query1['idcard']?></td>
      <input name="age" type="hidden" value="<?=$age1?>"/>
      <input name="camp" type="hidden" value="<?=$query1['camp']?>"/>
      </tr>
    <tr>
      <td class="pdx">������� :
        <? echo $query1['address']." �Ӻ�".$query1['tambol']." �����".$query1['ampur']." �ѧ��Ѵ".$query1['changwat']?> ���Ѿ�� : <?=$query1['phone']?></td>
    </tr>
    <tr>
      <td class="pdx">���ͪҵ� : <?=$query1['race']?> �ѭ�ҵ� : <?=$query1['nation']?> ��ʹ� : <?=$query1['religion']?> </td>
    </tr>
    <tr>
      <td class="pdx">��������ʹ : <?=$query1['blood']?>         ʶҹ�Ҿ  <?=$query1['married']?></td>
    </tr>
    <tr>
      <td class="pdx">�Դ� : <?=$query1['father']?> ��ô� : <?=$query1['mother']?> ������� : <?=$query1['couple']?> </td>
    </tr>
    <tr>
      <td class="pdx"> ���������ö�Դ����� : <?=$query1['ptf']?> ����Ǣ�ͧ�� <?=$query1['ptfadd']?>  ���Ѿ�� <?=$query1['ptffone']?></td>
    </tr>
    <tr>
      <td class="pdx">�Է�ԡ���ѡ�� <?=$query1['ptright']?></td>
    </tr>
      </table>
      </td></tr>
    </table>
    <br />
	<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr><td>
    <table width="750">
    <tr>
      <td width="765" colspan="3" class="pdx"><strong>��õ�Ǩ��ҧ��·����</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="pdx"><strong>���˹ѡ</strong> :
<?=$query['weight']?>
         ��. 
         <strong>��ǹ�٧</strong> :
<?=$query['height']?>
 ��. 
 <strong>�ä��Шӵ��</strong> :
<?=$query['congenital_disease']?> <strong>����</strong> :
<?=$query['drugreact']?> </td>
      </tr>
    <tr>
      <td colspan="3" class="pdx"><strong>T</strong> :
<?=$query['temperature']?> C � <br />
        <strong>P</strong> :
<?=$query['pause']?> ����/�ҷ� <br />
<strong>R</strong> :
<?=$query['rate']?> ����/�ҷ� <br />
<strong>BP</strong> :
<?=$query['bp1']?>/<?=$query['bp2']?> mmHg.<br />
<span style="color:#F00"><strong>BMI</strong> :
<?=$query['bmi']?></span></td>
      </tr>
    <tr>
      <td colspan="3" class="pdx"><strong>�š�õ�Ǩ</strong> <input name="check1" type="radio" value="����" />���� <input name="check1" type="radio" value="�Դ����" />�Դ����</td>
    </tr>
      </table></td></tr>
    </table>
    <?
    $arrtype = array('��Ǩ x-ray �ʹ','��Ǩ���ö�Ҿ�ʹ','��Ǩ���ö�Ҿ������Թ','��Ǩ˹�ҷ��ͧ�Ѻ','��Ǩ˹�ҷ��ͧ�','��Ǩ��������ó�ͧ������ʹ','��Ǩ�������','��Ǩ����ҳ����˹ѡ');
	
	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit,normalrange  From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC ";

	$result_ua = mysql_query($sql);
	$ua = mysql_num_rows($result_ua);

	$sql = "Select labcode, result, unit,normalrange From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);
	$cbc = mysql_num_rows($result_cbc);
	
	$sql = "Select labcode, result, unit,normalrange From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') AND parentcode <> 'CBC' Order by labcode ASC ";
	$result_lab = mysql_query($sql);
	$lab = mysql_num_rows($result_lab);
	?><br />
    <table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr>
      <td>
      	<table width="255">
            <tr>
              <td width="126" class="pdx"><strong>�š�õ�Ǩ�͡�����</strong></td>
              <td width="117" class="pdx"><?=$query['cxr']?>&nbsp;<?=$query['reason_cxr']?></td>
            </tr>
       	</table>
      </td>
     </tr>
    </table>
    <br />
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr>
      <td class="pdxpro">

	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR class="tb_font">
		<TD class="pdx">
	&nbsp;<span class="style5">��õ�Ǩ�����������ó�Ẻ UA :</span> 
       <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange) = mysql_fetch_row($result_ua)){
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
			}?>
		  </tr>
          <tr><td colspan="5"><strong>&nbsp;�š�õ�Ǩ</strong>
            <input type="radio" name="ua" value="����"/>
            ���� <input type="radio" name="ua" value="�Դ����"/>�Դ����</td></tr>
      </table>
	  <hr />
	  &nbsp;<span class="style5">��õ�Ǩ��������ó�ͧ������ʹ CBC :</span> 
	  <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange) = mysql_fetch_row($result_cbc)){
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
			}?>
		  </tr>
          <tr><td colspan="5"><strong>&nbsp;�š�õ�Ǩ</strong> <input type="radio" name="cbc" value="����"/>���� <input type="radio" name="cbc" value="�Դ����"/>�Դ����</td></tr>
      </table>
	  
		</TD>
	</TR>
	</TABLE>


</td>
    </tr>
    </table><br />

    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="95%">
    <tr>
    <td width="729"><table>
        <td class="pdxpro"><strong>��õ�Ǩ���ö�Ҿ������Թ</strong></td>
      </tr>
    <tr>
      <td class="pdx"><table width="719"><tr><td colspan="3" align="center"><strong>����������§�ٴ��·����</strong></td><td colspan="3" align="center"><strong>����������§�٧</strong></td></tr>
        <tr>
          <td width="71" align="center"><strong>����������§</strong></td>
          <td width="139" align="center">���</td>
          <td width="134" align="center">����</td>
          <td width="79" align="center"><strong>����������§</strong></td>
          <td width="134" align="center">���</td>
          <td width="134" align="center">����</td>
        </tr>
        <tr>
          <td align="center">500</td>
          <td align="center"><?=$query['hear500R']?></td>
          <td align="center"><?=$query['hear500L']?></td>
          <td align="center">3000</td>
          <td align="center"><?=$query['hear3000R']?></td>
          <td align="center"><?=$query['hear3000L']?></td>
        </tr>
        <tr>
          <td align="center">1000</td>
          <td align="center"><?=$query['hear1000R']?></td>
          <td align="center"><?=$query['hear1000L']?></td>
          <td align="center">4000</td>
          <td align="center"><?=$query['hear4000R']?></td>
          <td align="center"><?=$query['hear4000L']?></td>
        </tr>
        <tr>
          <td align="center">2000</td>
          <td align="center"><?=$query['hear2000R']?></td>
          <td align="center"><?=$query['hear2000L']?></td>
          <td align="center">6000</td>
          <td align="center"><?=$query['hear6000R']?></td>
          <td align="center"><?=$query['hear6000L']?></td>
        </tr>
        <tr>
          <td align="center">PTA</td>
          <td align="center"><?=$query['ptaRight1']?></td>
          <td align="center"><?=$query['ptaLeft1']?></td>
          <td align="center">8000</td>
          <td align="center"><?=$query['hear8000R']?></td>
          <td align="center"><?=$query['hear8000L']?></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">PTA</td>
          <td align="center"><?=$query['ptaRight2']?></td>
          <td align="center"><?=$query['ptaLeft2']?></td>
        </tr>
        <tr>
          <td align="center">LOW TONE</td>
          <td align="center"><?=$query['LowRight']?></td>
          <td align="center"><?=$query['LowLeft']?></td>
          <td align="center">HIGH TONE</td>
          <td align="center"><?=$query['HighRight']?></td>
          <td align="center"><?=$query['HighLeft']?></td>
        </tr>
      </table></td>
    </tr>
    </table>
    
</td>
</TR>
</TABLE><br />
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
<tr>
<td>
<table>
    <tr>
      <td colspan="4" class="pdx"><strong>��õ�Ǩ���ö�Ҿ�ʹ</strong></td>
      </tr>
    <tr>
      <td width="83" class="pdx">%FVC :</td>
      <td width="44" class="pdx"><?=$query['FVC1']?></td>
      <td width="44" class="pdx"><?=$query['FVC2']?></td>
      <td width="137" class="pdx"><?=$query['FVC3']?></td>
      </tr>
    <tr>
      <td class="pdx">%FEV1 :</td>
      <td class="pdx"><?=$query['FEV1']?></td>
      <td class="pdx"><?=$query['FEV2']?></td>
      <td class="pdx"><?=$query['FEV3']?></td>
      </tr>
    <tr>
      <td class="pdx">%R/O : </td>
      <td class="pdx"><?=$query['RO1']?></td>
      <td class="pdx"><?=$query['RO2']?></td>
      <td class="pdx"><?=$query['RO3']?></td>
      </tr>
    <tr>
      <td class="pdx">%PEF :</td>
      <td class="pdx"><?=$query['PEF1']?></td>
      <td class="pdx"><?=$query['PEF2']?></td>
      <td class="pdx"><?=$query['PEF3']?></td>
      </tr>
    <tr>
      <td colspan="4" class="pdx"><?=$query['reason_chest']?></td>
      </tr>
    <tr>
      <td colspan="4" class="pdx"><strong>�š�õ�Ǩ</strong>
        <input type="radio" name="check12" value="����"/>
        ����
        <input type="radio" name="check12" value="�Դ����"/>
        �Դ����</td>
      </tr>
    </table>
</td>
</tr>
</table>
<br />
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="pdx">
  <tr>
  	 <td><span class="style5">&nbsp;��õ�Ǩ��÷ӧҹ�ͧ�Ѻ����  :</span> 
	   <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange) = mysql_fetch_row($result_lab)){

			if(!empty($arr_dxofyear[$list_lab[$labname]]))
			$labresult = $arr_dxofyear[$list_lab[$labname]];

	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_lab[$labname];?>" type="text" value="<?php echo $labresult;?>" size="6" readonly />&nbsp;(<?php echo $normalrange;?>)
&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
          <tr>
            <td colspan="5"><strong>&nbsp;�š�õ�Ǩ�Ѻ</strong> <input type="radio" name="check2" value="����"/>���� <input type="radio" name="check2" value="�Դ����"/>�Դ����</td></tr>
          <tr>
            <td colspan="5"><strong>&nbsp;�š�õ�Ǩ�</strong> <input type="radio" name="check3" value="����"/>���� <input type="radio" name="check3" value="�Դ����"/>�Դ����</td>
          </tr>
		</table>
	</td>
	</tr>
</table>
<br />
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="pdx">
  <tr>
  	 <td>
     <table>
    <tr>
      <td colspan="4" class="pdx"><strong>��õ�Ǩ����ҳ����˹ѡ</strong></td>
      </tr>
    <tr>
      <td width="169" class="pdx">��Ǩ��õС�������ʹ :        </td>
      <td width="56" class="pdx"><?=$query['lead']?></td>
      <td width="78" class="pdx">&lt;40 ug/dl</td>
      <td width="387" class="pdx"><input name="check4" type="radio" id="pod9" value="����"/>
����
  <input type="radio" name="check4" id="pod10" value="�Դ����"/>
  �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ���ᤴ���������ʹ :        </td>
      <td class="pdx"><?=$query['cadmium']?></td>
      <td class="pdx">&lt;5 ug/L</td>
      <td class="pdx"><input name="check5" type="radio" id="pod11" value="����"/>
        ����
          <input type="radio" name="check5" id="pod12" value="�Դ����"/>
          �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ����������㹻������ :</td>
      <td class="pdx"><?=$query['chromium']?></td>
      <td class="pdx">&lt;5 ug/g</td>
      <td class="pdx"><input name="check6" type="radio" id="pod13" value="����"/>
����
  <input type="radio" name="check6" id="pod14" value="�Դ����"/>
�Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ���˹�㹻������ :        </td>
      <td class="pdx"><?=$query['arsenic']?></td>
      <td class="pdx">&lt;50 ug/L</td>
      <td class="pdx"><input name="check7" type="radio" id="pod15" value="����"/>
        ����
          <input type="radio" name="check7" id="pod16" value="�Դ����"/>
          �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ��û�ͷ����ʹ :        </td>
      <td class="pdx"><?=$query['mercury']?></td>
      <td class="pdx">&lt;2 ug/dl</td>
      <td class="pdx"><input name="check8" type="radio" id="pod17" value="����"/>
        ����
          <input type="radio" name="check8" id="pod18" value="�Դ����"/>
          �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">�дѺ��÷ͧᴧ����ʹ :        </td>
      <td class="pdx"><?=$query['copper']?></td>
      <td class="pdx">70-160</td>
      <td class="pdx"><input name="check9" type="radio" id="pod19" value="����"/>
����
  <input type="radio" name="check9" id="pod20" value="�Դ����"/>
  �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">�дѺ��ùԡ���㹻������ :        </td>
      <td class="pdx"><?=$query['nickel']?></td>
      <td class="pdx">&lt;5 ug/L</td>
      <td class="pdx"><input name="check10" type="radio" id="pod21" value="����"/>
����
  <input type="radio" name="check10" id="pod22" value="�Դ����"/>
  �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">�дѺ��þ�ǧ㹻������ :        </td>
      <td class="pdx"><?=$query['antimony']?></td>
      <td class="pdx">&lt;1 ug/g</td>
      <td class="pdx"><input name="check11" type="radio" id="pod23" value="����"/>
        ����
          <input type="radio" name="check11" id="pod24" value="�Դ����"/>
          �Դ����</td>
    </tr>
    </table>
     </td>
	</tr>
</table>
<BR>


<center>
<input name="submit2" type="submit" id="submit2" value=" ��ŧ "  />&nbsp;&nbsp;
<!--<input name="submit2" type="submit" value="��ŧ&amp;ʵԡ���� OPD" />-->
</center>
<INPUT TYPE="hidden" value="<?php echo $query["row_id"];?>" name="row_id" />
<INPUT TYPE="hidden" value="<?php echo $query['hn'];?>" name="hn" />
</FORM>
<?php }}?>



<?php 
include("unconnect.inc");
 ?>
</body>


</html>
