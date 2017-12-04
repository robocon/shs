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

<form action="dx_ofyear_group_dr.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">��͡�����Ţ HN</TD>
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
<FORM METHOD=POST ACTION="dx_ofyear_save_group_dr.php" target="_blank">
<?
if(isset($_POST['Submit1'])){
	$sql = "select * from condxofyear where hn= '".$_POST['p_hn']."'";
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
      <tr>
        <td>
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
    <tr>
      <td class="pdx"><strong>
        <?=$query['type_check']?>
      </strong></td>
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
      <td colspan="3" class="pdx"><strong>�š�õ�Ǩ</strong> <input name="check1" type="radio" value="����" <? if($query['general']=="����") echo "checked"?> onclick="togglediv2('wrong1')"/>���� <input name="check1" type="radio" value="�Դ����" <? if($query['general']!="����") echo "checked"?> onclick="togglediv1('wrong1')"/>�Դ���� 
      <div style="display:none" id="wrong1"><select name="wrong" >
      <option value="�����Ф����ѹ���Ե�٧">�����Ф����ѹ���Ե�٧</option>
      <option value="���˹ѡ���¡���ࡳ�컡��">���˹ѡ���¡���ࡳ�컡��</option>
      <option value="���˹ѡ�Թࡳ�컡��">���˹ѡ�Թࡳ�컡��</option>
      <option value="��������ǹ">��������ǹ</option>
      <option value="�����Ф����ѹ���Ե�٧,���˹ѡ���¡���ࡳ�컡��">�����Ф����ѹ���Ե�٧,���˹ѡ���¡���ࡳ�컡��</option>
      <option value="�����Ф����ѹ���Ե�٧,���˹ѡ�Թࡳ�컡��">�����Ф����ѹ���Ե�٧,���˹ѡ�Թࡳ�컡��</option>
      <option value="�����Ф����ѹ���Ե�٧,��������ǹ">�����Ф����ѹ���Ե�٧,��������ǹ</option>
      </select></div>
      </td>
    </tr>
      </table></td></tr>
    </table>
    <?
    $arrtype = array('��Ǩ x-ray �ʹ','��Ǩ���ö�Ҿ�ʹ','��Ǩ���ö�Ҿ������Թ','��Ǩ˹�ҷ��ͧ�Ѻ','��Ǩ˹�ҷ��ͧ�','��Ǩ��������ó�ͧ������ʹ','��Ǩ�������','��Ǩ����ҳ����˹ѡ');
	
	/*$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit  From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC ";

	$result_ua = mysql_query($sql);
	$ua = mysql_num_rows($result_ua);

	$sql = "Select labcode, result, unit From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);
	$cbc = mysql_num_rows($result_cbc);
	
	$sql = "Select labcode, result, unit From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') AND parentcode <> 'CBC' Order by labcode ASC ";
	$result_lab = mysql_query($sql);
	$lab = mysql_num_rows($result_lab);*/
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
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr>
      <td class="pdxpro">
      <?
      if($ua!="0"){
	  ?>
	<TABLE width="684" border="0" cellpadding="0" cellspacing="0">
	<TR class="tb_font">
		<TD width="684" class="pdx">
	&nbsp;<span class="style5">��õ�Ǩ�����������ó�Ẻ UA :</span> 
       <table width="100%" border="0">
	  <tr>
	    <td width="8%" align="right" class="tb_font_2">Color:</td><td width="10%" ><strong>
	      <?=$query['ua_color']?>
	    </strong></td>
	    <td width="10%" align="right" class="tb_font_2">SP.Gr:</td>
	    <td width="9%"><strong>
	      <?=$query['ua_spgr']?>
	    </strong></td>
	    <td width="13%"  align="right" class="tb_font_2">PH:</td>
	    <td width="10%" ><strong>
	      <?=$query['ua_phu']?>
	    </strong></td>
	    <td width="10%"  align="right" class="tb_font_2">Blood:</td>
	    <td width="11%"  ><strong>
	      <?=$query['ua_bloodu']?>
	    </strong></td>
	    <td width="10%" align="right" class="tb_font_2">Protien:</td><td width="9%"><strong>
	      <?=$query['ua_prou']?>
	    </strong></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Sugar:</td><td><strong>
          <?=$query['ua_gluu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Ketone:</td>
        <td><strong>
          <?=$query['ua_ketu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Urobillinogen:</td>
        <td><strong>
          <?=$query['ua_urobil']?>
        </strong></td>
        <td align="right" class="tb_font_2">Billirubin</td>
        <td><strong>
          <?=$query['ua_bili']?>
        </strong></td>
        <td align="right" class="tb_font_2">Nitrite</td><td><strong>
          <?=$query['ua_nitrit']?>
        </strong></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Crystal:</td><td><strong>
          <?=$query['ua_crystu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Casts:</td>
        <td><strong>
          <?=$query['ua_castu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Epithelial:</td>
        <td><strong>
          <?=$query['ua_epiu']?>
        </strong></td>
        <td align="right" class="tb_font_2">WBC:</td>
        <td><strong>
          <?=$query['ua_wbcu']?>
        </strong></td>
        <td align="right" class="tb_font_2">RBC:</td><td><strong>
          <?=$query['ua_rbcu']?>
        </strong></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Amorphous:</td><td><strong>
          <?=$query['ua_amopu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Bacteria:</td>
        <td><strong>
          <?=$query['ua_bactu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Mucus:</td>
        <td><strong>
          <?=$query['ua_mucosu']?>
        </strong></td>
        <td align="right" class="tb_font_2">Yeast:</td>
        <td><strong>
          <?=$query['ua_yeast']?>
        </strong></td>
        <td align="right" class="tb_font_2">Appear:</td><td><strong>
          <?=$query['ua_appear']?>
        </strong></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Otheru:</td>
        <td><strong>
          <?=$query['otheru']?>
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
      
	  <?php
	  /*$i=1;
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
			}*/?>
		  
          <tr><td colspan="3"><strong>&nbsp;�š�õ�Ǩ</strong>
            <input type="radio" name="ua" value="����" <? if($query['stat_ua']=="����") echo "checked"?>/>
            ���� <input type="radio" name="ua" value="�Դ����" <? if($query['stat_ua']=="�Դ����") echo "checked"?>/>�Դ����</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table>
	  <hr />
      <? }if($cbc!="0"){?>
	  &nbsp;<span class="style5">��õ�Ǩ��������ó�ͧ������ʹ CBC :</span> 
	  <table border="0">
	  <?php
	 /* $i=1;
	  	while(list($labname,$labresult, $unit) = mysql_fetch_row($result_cbc)){
		if($labname == "OTHER" || $labname == "PLTS"){
			$size="13";
		}else{
			$size="6";
		}
		if(!empty($arr_dxofyear[$list_cbc[$labname]]))
			$labresult = $arr_dxofyear[$list_cbc[$labname]];*/
	  ?>
           <tr>
          <td width="68" align="right" class="tb_font_2">WBC :</td>
          <td width="54"><strong><?=$query['cbc_wbc']?></strong></td>
          <td width="65" align="right" class="tb_font_2">HCT : </td>
          <td width="54"><strong><?=$query['cbc_hct']?></strong></td>
          <td width="83" align="right" class="tb_font_2">NEU :</td>
          <td width="52"><strong><?=$query['cbc_neu']?></strong></td>
          <td width="71" align="right" class="tb_font_2">LYMP : </td>
          <td width="54"><strong><?=$query['cbc_lymp']?></strong></td>
          <td width="99" align="right" class="tb_font_2">MONO : </td>
          <td width="89"><strong><?=$query['cbc_mono']?></strong></td>
		  </tr>
          <tr>
            <td align="right" class="tb_font_2">EOS : </td>
            <td><strong><?=$query['cbc_eos']?></strong></td>
            <td align="right" class="tb_font_2">MCV :</td>
            <td><strong><?=$query['cbc_mcv']?></strong></td>
            <td align="right" class="tb_font_2">MCH :</td>
            <td><strong><?=$query['cbc_mch']?></strong></td>
            <td align="right" class="tb_font_2">MCHC : </td>
            <td><strong><?=$query['cbc_mchc']?></strong></td>
            <td align="right" class="tb_font_2">PLTS :</td>
            <td><strong><?=$query['cbc_plts']?></strong></td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2">OTHER : </td>
          <td><strong><?=$query['cbc_other']?></strong></td>
          <td align="right" class="tb_font_2">NRBC : </td>
          <td><strong><?=$query['cbc_nrbc']?></strong></td>
          <td align="right" class="tb_font_2">RBC :</td>
          <td><strong><?=$query['cbc_rbc']?></strong></td>
          <td align="right" class="tb_font_2">RBCMOR : </td>
          <td><strong><?=$query['cbc_rbcmor']?></strong></td>
          <td align="right" class="tb_font_2">HB :</td>
          <td><strong><?=$query['cbc_hb']?></strong></td>
		  </tr>
          <tr>
            <td align="right" class="tb_font_2">BASO :</td>
            <td><strong><?=$query['cbc_baso']?></strong></td>
            <td align="right" class="tb_font_2">ATYP :</td>
            <td><strong><?=$query['cbc_atyp']?></strong></td>
            <td align="right" class="tb_font_2">BAND :</td>
            <td><strong><?=$query['cbc_band']?></strong></td>
            <td align="right" class="tb_font_2">PLTC : </td>
            <td><strong><?=$query['cbc_pltc']?></strong></td>
            <td align="right" class="tb_font_2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr><td colspan="10"><strong>&nbsp;�š�õ�Ǩ</strong> <input type="radio" name="cbc" value="����" <? if($query['stat_cbc']=="����") echo "checked"?>/>���� <input type="radio" name="cbc" value="�Դ����" <? if($query['stat_cbc']=="�Դ����") echo "checked"?>/>�Դ����</td></tr>
      </table>
	  
		</TD>
	</TR>
	</TABLE>

<? }
?>
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
      <td class="pdx">&nbsp;</td>
      <td align="center" class="pdx"><strong>PRE#1</strong></td>
      <td align="center" class="pdx"><strong>PREDICTED</strong></td>
      <td align="center" class="pdx"><strong>%PREDICTED</strong></td>
    </tr>
    <tr>
      <td width="83" class="pdx"><strong>FVC :</strong></td>
      <td align="center" class="pdx"><input name="FVC1" type="text" size="5" value="<?=$query['FVC1']?>" /></td>
      <td align="center" class="pdx"><input name="FVC2" type="text" size="5" value="<?=$query['FVC2']?>" /></td>
      <td align="center" class="pdx"><input name="FVC3" type="text" size="5" value="<?=$query['FVC3']?>" /></td>
      </tr>
    <tr>
      <td class="pdx"><strong>FEV1 :</strong></td>
      <td align="center" class="pdx"><input name="FEV1" type="text" size="5" value="<?=$query['FEV1']?>" /></td>
      <td align="center" class="pdx"><input name="FEV2" type="text" size="5" value="<?=$query['FEV2']?>" /></td>
      <td align="center" class="pdx"><input name="FEV3" type="text" size="5" value="<?=$query['FEV3']?>" /></td>
      </tr>
    <tr>
      <td class="pdx"><strong>FEV1% : </strong></td>
      <td align="center" class="pdx"><input name="RO1" type="text" size="5" value="<?=$query['RO1']?>" /></td>
      <td align="center" class="pdx"><input name="RO2" type="text" size="5" value="<?=$query['RO2']?>" /></td>
      <td align="center" class="pdx"><input name="RO3" type="text" size="5" value="<?=$query['RO3']?>" /></td>
      </tr>
    <tr>
      <td class="pdx"><strong>PEF :</strong></td>
      <td align="center" class="pdx"><input name="PEF1" type="text" size="5" value="<?=$query['PEF1']?>" /></td>
      <td align="center" class="pdx"><input name="PEF2" type="text" size="5" value="<?=$query['PEF2']?>" /></td>
      <td align="center" class="pdx"><input name="PEF3" type="text" size="5" value="<?=$query['PEF3']?>" /></td>
      </tr>
    <tr>
      <td colspan="4" class="pdx"><strong>�š�õ�Ǩ</strong>
        <input type="radio" name="check12" value="����" <? if($query['stat_chest']=="����") echo "checked"?>/>
        ����
        <input type="radio" name="check12" value="�Դ����" <? if($query['stat_chest']=="�Դ����") echo "checked"?>/>
        �Դ����</td>
      </tr>
    </table>
</td>
</tr>
</table>
<br />
<? if($lab!="0"){?>
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="pdx">
  <tr>
  	 <td><span class="style5">&nbsp;��õ�Ǩ��÷ӧҹ�ͧ�Ѻ����  :</span> 
	   <table width="100%" border="0">
	  <tr>
<td width="116"><strong>AST</strong> :
<?=$query['sgot']?> (0-40)</td><td width="123"><strong>ALT </strong>:
<?=$query['sgpt']?> (0-38)</td><td width="143"><strong>ALP</strong> :
<?=$query['alk']?> (34-123)</td>
<td width="138"><strong>BUN</strong> :
<?=$query['bun']?> (7.0-21.0)</td><td width="148"><strong>CREA</strong> :
<?=$query['cr']?> (0.7-1.4)</td>
</tr>
	  <?php
	  /*$i=1;
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
			}*/?>
          <tr>
            <td colspan="7"><strong>&nbsp;�š�õ�Ǩ�Ѻ</strong> <input type="radio" name="check2" value="����" <? if($query['stat_sgot']=="����") echo "checked"?>/>���� <input type="radio" name="check2" value="�Դ����" <? if($query['stat_sgot']=="�Դ����") echo "checked"?>/>�Դ����</td></tr>
          <tr>
            <td colspan="5"><strong>&nbsp;�š�õ�Ǩ�</strong> <input type="radio" name="check3" value="����" <? if($query['stat_bun']=="����") echo "checked"?>/>���� <input type="radio" name="check3" value="�Դ����" <? if($query['stat_bun']=="�Դ����") echo "checked"?>/>�Դ����</td>
          </tr>
		</table>
	</td>
	</tr>
</table>
<? }?>
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="pdx">
  <tr>
  	 <td>
     <table>
    <tr>
      <td colspan="3" class="pdx"><strong>��õ�Ǩ����ҳ����˹ѡ</strong></td>
      </tr>
    <tr>
      <td width="206" class="pdx">��Ǩ��õС�������ʹ :        </td>
      <td width="33" class="pdx"><?=$query['lead']?></td>
      <td width="379" class="pdx"><input type="radio" name="check4" id="pod9" value="����" <? if($query['resultlead']=="����") echo "checked"?>/>
����
  <input type="radio" name="check4" id="pod10" value="�Դ����" <? if($query['resultlead']=="�Դ����") echo "checked"?>/>
  �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ���ᤴ���������ʹ :         </td>
      <td class="pdx"><?=$query['cadmium']?></td>
      <td class="pdx"><input type="radio" name="check5" id="pod11" value="����" <? if($query['resultcadmium']=="����") echo "checked"?>/>
        ����
          <input type="radio" name="check5" id="pod12" value="�Դ����" <? if($query['resultcadmium']=="�Դ����") echo "checked"?>/>
          �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ����������㹻������ :  </td>
      <td class="pdx"><?=$query['chromium']?></td>
      <td class="pdx"><input type="radio" name="check6" id="pod13" value="����" <? if($query['resultchromium']=="����") echo "checked"?>/>
����
  <input type="radio" name="check6" id="pod14" value="�Դ����" <? if($query['resultchromium']=="�Դ����") echo "checked"?>/>
�Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ���˹�㹻������ :         </td>
      <td class="pdx"><?=$query['arsenic']?></td>
      <td class="pdx"><input type="radio" name="check7" id="pod15" value="����" <? if($query['resultarsenic']=="����") echo "checked"?>/>
        ����
          <input type="radio" name="check7" id="pod16" value="�Դ����" <? if($query['resultarsenic']=="�Դ����") echo "checked"?>/>
          �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">��Ǩ��û�ͷ����ʹ :         </td>
      <td class="pdx"><?=$query['mercury']?></td>
      <td class="pdx"><input type="radio" name="check8" id="pod17" value="����" <? if($query['resultmercury']=="����") echo "checked"?>/>
        ����
          <input type="radio" name="check8" id="pod18" value="�Դ����" <? if($query['resultmercury']=="�Դ����") echo "checked"?>/>
          �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">�дѺ��÷ͧᴧ����ʹ :         </td>
      <td class="pdx"><?=$query['copper']?></td>
      <td class="pdx"><input type="radio" name="check9" id="pod19" value="����" <? if($query['resultcopper']=="����") echo "checked"?>/>
����
  <input type="radio" name="check9" id="pod20" value="�Դ����" <? if($query['resultcopper']=="�Դ����") echo "checked"?>/>
  �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">�дѺ��ùԡ���㹻������ :         </td>
      <td class="pdx"><?=$query['nickel']?></td>
      <td class="pdx"><input type="radio" name="check10" id="pod21" value="����" <? if($query['resultnickel']=="����") echo "checked"?>/>
����
  <input type="radio" name="check10" id="pod22" value="�Դ����" <? if($query['resultnickel']=="�Դ����") echo "checked"?>/>
  �Դ����</td>
    </tr>
    <tr>
      <td class="pdx">�дѺ��þ�ǧ㹻������ :         </td>
      <td class="pdx"><?=$query['antimony']?></td>
      <td class="pdx"><input type="radio" name="check11" id="pod23" value="����" <? if($query['resultantimony']=="����") echo "checked"?>/>
        ����
          <input type="radio" name="check11" id="pod24" value="�Դ����" <? if($query['resultantimony']=="�Դ����") echo "checked"?>/>
          �Դ����</td>
    </tr>
    </table>
     </td>
	</tr>
</table>
<BR>
<table width="95%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" class="pdx">
  <tr>
  	 <td><table width="664" border="0">
  <?php
	  /*$i=1;
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
			}*/?>
  <tr>
            <td width="618" align="center"><strong>&nbsp;��ػ�š�õ�Ǩ������</strong> <input type="radio" name="sumary" value="����" <? if($query['summary']=="����") echo "checked";?>/>���� <input type="radio" name="sumary" value="�Դ����" <? if($query['summary']=="�Դ����") echo "checked";?>/>�Դ����</td></tr>
  <tr>
    <td><strong>�ѹ�֡�ҡᾷ��<br />
      <label></label>
      <textarea name="dx" id="dx" cols="60" rows="5"><?=$query['dx']?></textarea>
    </strong></td>
  </tr>
		</table>
	</td>
	</tr>
</table><br />



<center>
<input name="submit2" type="submit" value=" ��ŧ "  />&nbsp;&nbsp;
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
