<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
.tet {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.tet1 {
	font-family: "TH SarabunPSK";
	font-size: 36px;
}
.text3 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.text {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.texthead {
	font-family: "TH SarabunPSK";
	font-size: 25px;
}
.text1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.text2 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.textsub {
	font-size: 15px;
}
@media print{
#no-print{ display:none;}
}
.text4 {	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.text5 {font-family: "TH SarabunPSK";font-size: 16px; }
.style10 {font-size: 16px; font-weight: bold; }
.style11 {font-size: 16px}
.style16 {font-size: 18px}
.style17 {font-family: "TH SarabunPSK"; font-size: 18px; font-weight: bold; }
-->
</style>
<div id="no-print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1"><strong>�����㺵�Ǩ�آ�Ҿ�ͧ�Ѿ��</strong></span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
    <input name="hn" type="text" size="10" class="tet1" id="hn">
    &nbsp;
  <input type="submit" name="ok" value="��ŧ">
  <br />
  <br />
</center>
</form>
</div>
<? 
if(isset($_POST['hn']) || isset($_GET['hn'])){
?>
<script language="javascript">
	window.print();
</script>    
<?
	////*runno ��Ǩ�آ�Ҿ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
	$nPrefix2="25".$nPrefix;
////*runno ��Ǩ�آ�Ҿ*/////////

	//������ش
	if(isset($_POST['hn'])){
		$hn=$_POST['hn'];
	}else{
		$hn=$_GET['hn'];
	}
	
	$select = "select * from condxofyear_so where hn='".$hn."' order by row_id desc";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	
	$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='��Ǩ�آ�Ҿ��Шӻ�$nPrefix' ";
	$query1 = mysql_query($sql1); 	
	?>	
<table width="100%">
<tr>
  <td colspan="2">
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
  <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ��Шӻ� <?=$nPrefix2;?><br />��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��
</strong></td>
  <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
  <td align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">
  ��Ǩ������ѹ��� 
  <?
  $da = explode(" ",$result["thidate"]);
  $daten = explode("-",$da[0]);
  ?>
  <?=$daten[2]?>-<?=$daten[1]?>-<?=$daten[0]+543;?>&nbsp;���� <?=$da[1];?> �.
  </span></span></span></td>
  <td align="center" valign="top" class="text3">&nbsp;</td>
</tr>
</table></td></tr>
<tr>
  <td colspan="2" valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%" >
  <tr><td>
  <table width="100%" class="text1">
    <tr><td colspan="4" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?>      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>���� :</strong>    <span style="font-size:24px"><strong><?=$result['ptname']?></strong></span></td>
  <td colspan="2" valign="top" class="text2"><strong>���� :</strong>
    <?=$result['age']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text3"><strong>�ѧ�Ѵ : </strong> <span style="font-size:18px"><?=$result['camp'];?></span></span></td>
  </tr>
<tr>
  <td width="12%" valign="top"><span class="text3"><strong>���˹ѡ: </strong>
  <?=$result['weight']?> ��.</span></td>
  <td width="17%" valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
    <?=$result['height']?>
&nbsp;��.</span></td>
  <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong>
    <u><?=$result['bmi']?></u>
  </span></td>
  <td width="15%" valign="top"><span class="text3"><strong>�ͺ���:</strong>
    <?=$result['round_']?>
&nbsp;��.</span></td>
  <td width="19%" valign="top"><span class="text3"><strong>����:</strong> 
    <? if($result['drugreact']=="0" || $result['drugreact']==""){ echo "�������"; }else{
		$sql55 = "Select  drugreact From opcard  where hn = '".$result['hn']."' ";
		$result55 = mysql_query($sql55);
		$arr55 = mysql_fetch_array($result55);
			echo $arr55["drugreact"];
		}	
	?>
  </span></td>
  <td width="27%" valign="top"><span class="text3"><strong>�ä��Шӵ��:
  </strong>
    <? if($result['congenital_disease']=="") echo "�����"; else echo $result['congenital_disease']; ?>
  </span></td>
  </tr>
<tr>
  <td colspan="4" valign="top"><span class="text3"><strong>������: </strong>
    <? if($result['cigarette']=="0"){ echo "������ٺ";}else if($result['cigarette']=="1"){ echo "���ٺ ����ԡ����";}else if($result['cigarette']=="2"){ echo "�ٺ�繤��駤���";}else if($result['cigarette']=="3"){ echo "�ٺ�繻�Ш�";}?>
  </span><span class="text3"><strong>&nbsp;&nbsp;����: </strong>
    <? if($result['alcohol']=="0"){ echo "����´���";}else if($result['alcohol']=="1"){ echo "�´��� ����ԡ����";}else if($result['alcohol']=="2"){ echo "�����繤��駤���";}else if($result['alcohol']=="3"){ echo "�����繻�Ш�";}?>  
  &nbsp;&nbsp;</span><span class="text3"><strong>&nbsp;&nbsp;�͡���ѧ���: </strong>
    <? if($result['exercise']=="0"){ echo "������͡���ѧ���";} else if($result['exercise']=="1"){ echo "�͡���ѧ��� ��ӡ���ࡳ��";} else{ echo "�͡���ѧ��� ���ࡳ��";} ?>  
  &nbsp;&nbsp;</span><span class="text3"><strong>T:</strong>
<u><?=$result['temperature']?></u>
C �</span><span class="text3"><strong>&nbsp;&nbsp;P:
  </strong>
    <?=$result['pause']?>
&nbsp;����/�ҷ�</span></td>
  <td valign="top"><span class="text3"><strong>R: </strong>
    <?=$result['rate']?>
&nbsp;����/�ҷ�</span></td>
  <td valign="top"><span class="text3"><strong>BP:</strong>
    <u><?=$result['bp1']?>
/
<?=$result['bp2']?>
&nbsp;mmHg.</u></span></td>
</tr>
<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">��Ҥ����ѹ : </strong><?=$result['stat_pressure']?>
    <? if($result['stat_pressure']=="�Դ����") echo $result['reason_pressure'];?></td>
</tr>
<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">��� BMI : </strong>
    <?=$result['stat_bmi']?>
    <? if($result['stat_bmi']=="�Դ����") echo $result['reason_bmi'];?></td>
</tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td width="47%" align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" bgcolor="#CCCCCC"><span class="style10">��õ�Ǩ������ʹ </span></td>
            <td align="center" bgcolor="#CCCCCC"><span class="style10">�ŵ�Ǩ</span></td>
            <td align="center" bgcolor="#CCCCCC"><span class="style10">��һ���</span></td>
            <?php
					/*
					?>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>��ػ�š�õ�Ǩ</strong></td>
					<?php
					*/
					?>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='CBC' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and ( 
					labcode = 'WBC' 
					|| labcode ='EOS' 
					|| labcode ='HCT' 
					|| labcode ='PLTC' 
					|| labcode ='NEU' 
					|| labcode ='LYMP' 
				) ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="WBC"){
				$labmean="(��õ�Ǩ�Ѻ������ʹ���)";
			}else if($objResult["labcode"]=="NEU"){
				$labmean="(��õԴ����Ấ������)";
			}else if($objResult["labcode"]=="LYMP"){
				$labmean="(��õԴ��������� ���������������ʹ)";
			}else if($objResult["labcode"]=="MONO"){
				$labmean="(�ä����ǡѺ����� ���������������ʹ)";
			}else if($objResult["labcode"]=="EOS"){
				$labmean="(�ҡ�âͧ�ä����� ���;�Ҹ�)";
			}else if($objResult["labcode"]=="BASO"){
				$labmean="(������ä�����������ʹ���)";
			}else if($objResult["labcode"]=="ATYP"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="BAND"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="OTHER"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="NRBC"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="RBC"){
				$labmean="(������ʹᴧ)";
			}else if($objResult["labcode"]=="HB"){
				$labmean="(��õ�Ǩ�Ѵ��������鹢ͧ�����źԹ)";
			}else if($objResult["labcode"]=="HCT"){
				$labmean="(����Ѵ������ʹᴧ�Ѵ��)";
			}else if($objResult["labcode"]=="MCV"){
				$labmean="(����Ѵ����ҵ�������ʹᴧ��������)";
			}else if($objResult["labcode"]=="MCH"){
				$labmean="(���˹ѡ�ͧ�����źԹ�������ʹᴧ)";
			}else if($objResult["labcode"]=="MCHC"){
				$labmean="(��������������źԹ�������ʹᴧ)";
			}else if($objResult["labcode"]=="PLTC"){
				$labmean="(��õ�Ǩ�Ѻ������ʹ����ʹ)";
			}else if($objResult["labcode"]=="PLTS"){
				$labmean="";
			}else if($objResult["labcode"]=="RBCMOR"){
				$labmean="(�ٻ��ҧ������ʹᴧ)";
			}
			
			
				if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr>
            <td width="64%"><span class="style11">
              <?=$objResult["labcode"]." ".$labmean;?>
            </span></td>
            <td width="16%" align="center"><span class="style11">
              <?=$objResult["result"];?>
            </span></td>
            <td width="20%" align="center"><span class="style11">
              <?=$objResult["normalrange"];?>
            </span></td>
          </tr>
          <?  } ?>
          <?
 		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
 ?>
          <tr>
            <td colspan="3" height="27"><span class="style16">��ػ�ŵ�Ǩ :<strong>
              <?=$result['stat_cbc']?>
              <? if($result['stat_cbc']=="�Դ����") echo "���й�...".$result['reason_cbc'];?>
            </strong></span></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <td width="53%" align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>UA : ��õ�Ǩ��÷ӧҹ�ͧ�������</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text31">
          <tr>
            <td align="center" bgcolor="#CCCCCC"><span class="style10">��õ�Ǩ�������</span></td>
            <td align="center" bgcolor="#CCCCCC"><span class="style10">�ŵ�Ǩ</span></td>
            <td align="center" bgcolor="#CCCCCC"><span class="style10">��һ���</span></td>
            <?php
					/*
					?>
					<td width="15%" align="center" bgcolor="#CCCCCC"><strong>��ػ�š�õ�Ǩ</strong></td>
					<?php
					*/
					?>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and (labcode ='SPGR' || labcode ='PHU' || labcode ='GLUU' || labcode ='PROU' || labcode ='WBCU' || labcode ='RBCU' )";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="COLOR"){
				$labmean="(�բͧ�������)";
			}else if($objResult["labcode"]=="APPEAR"){
				$labmean="(������)";
			}else if($objResult["labcode"]=="SPGR"){
				$labmean="(������ǧ�����)";
			}else if($objResult["labcode"]=="PHU"){
				$labmean="(�����繡ô)";
			}else if($objResult["labcode"]=="BLOODU"){
				$labmean="(���ʹ㹻������)";
				$bloodvalue=$objResult["result"];
			}else if($objResult["labcode"]=="PROU"){
				$labmean="(�õչ㹻������)";
				$provalue=$objResult["result"];
			}else if($objResult["labcode"]=="GLUU"){
				$labmean="(��ӵ��㹻������)";
			}else if($objResult["labcode"]=="KETU"){
				$labmean="(��⵹㹻������)";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="(��÷����������ʹᴧ�٧)";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="(�����ٺԹ㹻������)";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="(��÷�㹻������)";
			}else if($objResult["labcode"]=="WBCU"){
				$labmean="(������ʹ���)";
			}else if($objResult["labcode"]=="RBCU"){
				$labmean="(������ʹᴧ)";
			}else if($objResult["labcode"]=="EPIU"){
				$labmean="(��������ͺ�)";
			}else if($objResult["labcode"]=="BACTU"){
				$labmean="(Ấ������)";
			}else if($objResult["labcode"]=="YEAST"){
				$labmean="(��ʵ�)";
			}else if($objResult["labcode"]=="MUCOSU"){
				$labmean="";
			}else if($objResult["labcode"]=="AMOPU"){
				$labmean="";
			}else if($objResult["labcode"]=="CASTU"){
				$labmean="(���õչ)";
			}else if($objResult["labcode"]=="CRYSTU"){
				$labmean="(��֡)";
			}else if($objResult["labcode"]=="OTHERU"){
				$labmean="(����)";
			}
						
			if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr>
            <td width="59%"><span class="style11">
              <?=$objResult["labcode"]." ".$labmean;?>
            </span></td>
            <td width="18%" ><span class="style11">
              <?=$objResult["result"];?>
            </span></td>
            <td width="23%" align="center"><span class="style11">
              <?=$objResult["normalrange"];?>
            </span></td>
          </tr>
          <?  } ?>
          <tr>
            <td height="27" colspan="3"><span class="style16">��ػ�ŵ�Ǩ : <strong>
				<?=$result['stat_ua']?>
                <? if($result['stat_ua']=="�Դ����") echo "���й�...".$result['reason_ua'];?>             
            </strong></span></td>
          </tr>
      </table></td>
    </tr>
  </table>    </tr>
<tr>
  <td colspan="2" valign="top" class="text">
  <table width="100%"  bordercolor="#FFFFFF" border="0"  cellpadding="0" cellspacing="0">
  
    <tr>
      <td valign="top" class="text3"><strong class="text5" style="font-size:20px"><u>��õ�Ǩ�ҧ��ͧ��Ժѵԡ��</u></strong><strong>&nbsp;</strong></td>
      <td align="left" class="text3"><strong>�ŵ�Ǩ</strong></td>
      <!--<td valign="top" width="4%"  class="text3" bordercolor="#000000"><strong>2555</strong></td>-->
      <td width="0%" align="left" bordercolor="#000000"  class="style17">&nbsp;</td>
      <td align="left" class="text"><span class="style17">��һ���</span></td>
      <td align="left" class="text"><span class="style17">��ػ��</span></td>
    </tr>
    <? if($result['bs']!=""){?>
    <tr>
      <td width="26%" valign="top" class="text3"><strong>GLU(����ҹ) :</strong></td>
     <!-- <td width="4%" align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['bs']?>
      </strong></td>-->
        <td width="8%" align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['bsflag']=="N"){
				echo $result['bs'];
			}else{
        		echo "<strong>$result[bs]</strong>";
        	}
		?>        </td>
        <td width="0%" align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td width="9%" valign="top" class="text">(<?=$result['bsrange']?>)</td>
        <td width="57%" valign="top" class="text"><strong>
          <?=$result['stat_bs']?>
        </strong>
          <? if($result['stat_bs']=="�Դ����") echo $result['reason_bs']."...";?></td>
      </tr>
      <? } 
	  if($result['chol']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>CHOL(��õ�Ǩ��ѹ) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['chol']?>
        </strong></td>-->
        <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['cholflag']=="N"){
				echo $result['chol'];
			}else{
        		echo "<strong>$result[chol]</strong>";
        	}
		?>		</td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['cholrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_chol']?>
        </strong>
          <? if($result['stat_chol']=="�Դ����") echo $result['reason_chol']."...";?></td>
      </tr>
      <? } 
	  if($result['tg']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>TRIG(��õ�Ǩ��ѹ) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['tg']?>
        </strong></td>-->
        <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['tgflag']=="N"){
				echo $result['tg'];
			}else{
        		echo "<strong>$result[tg]</strong>";
        	}
		?>        </td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['tgrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_tg']?>
        </strong>
          <? if($result['stat_tg']=="�Դ����") echo $result['reason_tg']."...";?></td>
      </tr>
      <tr>
        <td valign="top" class="text3"><strong>HDL(��ѹ��) :</strong></td>
        <td align="left" valign="top" bordercolor="#000000" class="text3"><?
        	if($result['hdlflag']=="N"){
				echo $result['hdl'];
			}else{
        		echo "<strong>$result[hdl]</strong>";
        	}
		?>        </td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(
            <?=$result['hdlrange']?>
          )</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_hdl']?>
          </strong>
            <? if($result['stat_hdl']=="�Դ����") echo $result['reason_hdl']."...";?></td>
        </tr>
      <tr>
        <td valign="top" class="text3"><strong>LDL(��ѹ���) :</strong></td>
        <td align="left" valign="top" bordercolor="#000000" class="text3"><?
        	if($result['ldlflag']=="N"){
				echo $result['ldl'];
			}else{
        		echo "<strong>$result[ldl]</strong>";
        	}
		?>
        </td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(
            <?=$result['ldlrange']?>
          )</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_ldl']?>
          </strong>
            <? if($result['stat_ldl']=="�Դ����") echo $result['reason_ldl']."...";?></td>
        </tr>
      <? } 
	  if($result['bun']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>BUN(��÷ӧҹ�ͧ�) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['bun']?>
        </strong></td>-->
        <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['bunflag']=="N"){
				echo $result['bun'];
			}else{
        		echo "<strong>$result[bun]</strong>";
        	}
		?>        </td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['bunrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_bun']?>
        </strong>
          <? if($result['stat_bun']=="�Դ����") echo $result['reason_bun']."...";?></td>
      </tr>
      <? } 
	  if($result['cr']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>CREA(��÷ӧҹ�ͧ�) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['cr']?>
        </strong></td>-->
        <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['crflag']=="N"){
				echo $result['cr'];
			}else{
        		echo "<strong>$result[cr]</strong>";
        	}
		?>        </td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['crrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_cr']?>
        </strong>
          <? if($result['stat_cr']=="�Դ����") echo $result['reason_cr']."...";?></td>
      </tr>
      <? } 
	  if($result['alk']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>ALP(��÷ӧҹ�ͧ�Ѻ,��д١) :</strong></td>
     <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['alk']?>
      </strong></td>-->
      <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['alkflag']=="N"){
				echo $result['alk'];
			}else{
        		echo "<strong>$result[alk]</strong>";
        	}
		?>      </td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['alkrange']?>)</td>
      <td valign="top" class="text"><strong><strong>
        <?=$result['stat_sgot']?>
      </strong></strong><? if($result['stat_sgot']=="�Դ����") echo $result['reason_sgot']."...";?></td>
      </tr>
      <? } 
	  if($result['sgpt']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>ALT(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgpt']?>
      </strong></td>-->
      <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['sgptflag']=="N"){
				echo $result['sgpt'];
			}else{
        		echo "<strong>$result[sgpt]</strong>";
        	}
		?>      </td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['sgptrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_sgpt']?>
      </strong>
        <? if($result['stat_sgpt']=="�Դ����") echo $result['reason_sgpt']."...";?></td>
    </tr>
    <? } 
	  if($result['sgot']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>AST(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgot']?>
      </strong></td>-->
      <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['sgotflag']=="N"){
				echo $result['sgot'];
			}else{
        		echo "<strong>$result[sgot]</strong>";
        	}
		?>      </td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['sgotrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_alk']?>
      </strong>
        <? if($result['stat_alk']=="�Դ����") echo $result['reason_alk']."...";?></td>
    </tr>
    <? } 
	  if($result['uric']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>URIC(�ä��ҷ�) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['uric']?>
      </strong></td>-->
      <td align="left" valign="top" bordercolor="#000000" class="text3">
        <?
        	if($result['uricflag']=="N"){
				echo $result['uric'];
			}else{
        		echo "<strong>$result[uric]</strong>";
        	}
		?>      </td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['uricrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_uric']?>
      </strong>
        <? if($result['stat_uric']=="�Դ����") echo $result['reason_uric']."...";?></td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top"> <hr /></td>
    </tr>
	<? }
	?>
    
    <tr>
      <td valign="top" class="text3" width="26%"><strong>CXR ��õ�Ǩ��硫�����ʹ :</strong></td>
     <!-- <td align="left" valign="top" class="text3" width="4%"><strong>
        <?//=$result5['cxr']?>
      </strong></td>-->
      <td colspan="4" align="left" valign="top" class="text3"><strong>
        <?=$result['cxr']?>
      </strong>
        <? if($result['cxr']=="�Դ����") echo "���й�...".$result['reason_cxr']."...";?></td>
      </tr>
      <? 
	  if($result['pap']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>PAP ��õ�Ǩ����移ҡ���١ :</strong></td>
      <td colspan="5" align="left" valign="top" class="text3"><strong>
        <?=$result['pap']?>
        </strong>
        <? if($result['pap']=="�Դ����") echo "���й�...".$result['reason_pap']."...";?></td>
      </tr>
    <? }
	if($result['other1']!=""){?>
    <tr>
      <td colspan="6" valign="top"><strong>��õ�Ǩ�������� � </strong></td>
    </tr>
    <tr>
      <td width="26%" valign="top" class="text3"><strong>
        <?=$result['other1']?>
      :</strong></td>
      <td colspan="5" valign="top" class="text3"><span class="text3">
        <?=$result['stat_other1']?>
        <? if($result['stat_other1']=="�Դ����") echo "���й�...".$result['reason_other1']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other2']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other2']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other2']?>
        <? if($result['stat_other2']=="�Դ����") echo "���й�...".$result['reason_other2']."...";?>
      </span></td>
      </tr>
	<? }
	if($result['other3']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other3']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other3']?>
        <? if($result['stat_other3']=="�Դ����") echo "���й�...".$result['reason_other3']."...";?>
      </span></td>
      </tr>
	<? }
	if($result['other4']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other4']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other4']?>
        <? if($result['stat_other4']=="�Դ����") echo "���й�...".$result['reason_other4']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other5']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other5']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other5']?>
        <? if($result['stat_other5']=="�Դ����") echo "���й�...".$result['reason_other5']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other6']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other6']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other6']?>
        <? if($result['stat_other6']=="�Դ����") echo "���й�...".$result['reason_other6']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other7']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other7']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other7']?>
        <? if($result['stat_other7']=="�Դ����") echo "���й�...".$result['reason_other7']."...";?>
      </span></td>
      </tr>
      <? }?>
    <tr>
      <td height="27" colspan="6" align="center" valign="top" class="text1"><hr /><strong>��ػ�š�õ�Ǩ�آ�Ҿ</strong>&nbsp;<u>
	  <?
	  $summary="";
	  if($result['sum1']!=""){ 
	  
	  echo $summary=$result['sum1'];
	  
	  }else{
		  for($p=2;$p<6;$p++){
			 if($result['sum'.$p]!=''){
				 if($p==2){
				 	$summary .= $result['sum'.$p]."(".$result['rs_sum21']." ".$result['rs_sum22']." ".$result['rs_sum23']." ".$result['rs_sum24']." ".$result['rs_sum25']."),";
				 }elseif($p==5){
				 	$summary .= $result['sum'.$p]."(".$result['rs_sum51']." ".$result['rs_sum52']." ".$result['rs_sum53']."),";
				 }elseif($p==6){
				 	$summary .= $result['sum'.$p]."(".$result['rs_sum61'].")";
				 }else{
			 		$summary .= $result['sum'.$p].",";
				 }
				// if($result['sum'.($p+1)]!=''){$summary .= ",";}
			 }
		  }
		  echo $summary;
	  }
	  
	 ?></u>     </td>
     </tr>
</table>
</td>
</tr>
    <tr>
  <td colspan="2" valign="top" class="text2"><? if(empty($result['diag'])){ echo "";}else{ echo "<strong>Diag</strong> : $result[diag] <strong >";}?> <strong>�����Դ��繨ҡᾷ��</strong>
&nbsp;<?=$result['dx']?></td>
  </tr>
  <?
  $dr =explode(" ",$result['doctor']);
  ?>
    <tr>
      <td colspan="2" align="right" valign="top" class="text2"><span class="text1">ᾷ�� <?=$result['doctor'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
    </tr>
</table>
<?
}
?>