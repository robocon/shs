<?
session_start();
if (isset($sIdname)){} else {die;} //for security
include("connect.inc");

$row_id=$_GET["id"];
$yearchkup=$_GET["chkyear"];
$nPrefix2="25".$yearchkup;
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
.text211 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.textsub {
	font-size: 15px;
}
.text31 {	font-family: "TH SarabunPSK";
	font-size: 16px;
	}
.text311 {	font-family: "TH SarabunPSK";
	font-size: 13px;
}
-->
</style>
<?
$select = "select * from armychkup where row_id='".$row_id."'";
$row = mysql_query($select);
$result = mysql_fetch_array($row);

$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='��Ǩ�آ�Ҿ��Шӻ�$chkyear' ";
$query1 = mysql_query($sql1); 
?>
<table width="100%">
<tr>
  <td colspan="2">
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
  <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ��Шӻ� <?=$nPrefix2;?></strong></td>
  <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
  <td align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 
  <?
  $da = explode(" ",$result["registerdate"]);
  $daten = explode("-",$da[0]);
  ?>
    <?=$daten[2]?>/<?=$daten[1]?>/<?=$daten[0]+543;?>&nbsp;<?=$da[1]?>
  </span></span></span></td>
  <td align="center" valign="top" class="text3">&nbsp;</td>
</tr>
</table></td></tr>
<tr>
  <td colspan="2" valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%" >
  <tr><td>
  <table width="100%" class="text1"><tr><td width="14%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="2" valign="top" class="text2"><strong>���� :</strong>    <span style="font-size:20px"><strong><?=$result['yot']." ".$result['ptname']?></strong></span></td>
  <td width="18%" valign="top" class="text2"><strong>���� :</strong>
    <?=$result['age']?></td>
  <td colspan="2" valign="top" class="text2"><span class="text3"><strong>�ѧ�Ѵ : </strong> <span style="font-size:18px"><strong>
  <?= substr($result['camp'],4)?>
  </strong></span></span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>���˹ѡ: </strong>
      <?=$result['weight']?>
      ��.</span></td>
  <td width="18%" valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
      <?=$result['height']?>
��.</span></td>
  <td width="12%" valign="top"><span class="text3"><strong>BMI: </strong> <u>
    <?=$result['bmi']?>
  </u></span></td>
  <td valign="top"><span class="text3"><strong>�ͺ���:</strong>
      <?=$result['waist']?>
����</span></td>
  <td width="22%" valign="top"><span class="text3"><strong>BP:</strong> <u>
  <?=$result['bp1']?>
mmHg.</u>
      <? if(!empty($result['bp2'])){ ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BP2:</strong> <u>
<?=$result['bp2']?>
mmHg.</u>
<? } ?>
  </span></td>
  <td width="16%" valign="top"><span class="text3"><strong>�س�����:</strong> <u>
  <?=$result['temperature']?>
  </u> C �</span></td>
</tr>
<tr>
  <td valign="top"><span class="text3"><strong>�վ��: </strong>
      <?=$result['pulse']?>
����/�ҷ�</span></td>
  <td valign="top"><span class="text3"><strong>����: </strong>
      <?=$result['rate']?>
����/�ҷ�</span></td>
  <td valign="top"><span class="text3"><strong>������: </strong>
      <? if($result['cigarette']=="0"){ echo "������ٺ";}else if($result['cigarette']=="1"){ echo "���ٺ ����ԡ����";}else if($result['cigarette']=="2"){ echo "�ٺ�繤��駤���";}else if($result['cigarette']=="3"){ echo "�ٺ�繻�Ш�";}?>
  </span></td>
  <td valign="top"><span class="text3"><strong>����: </strong>
      <? if($result['alcohol']=="0"){ echo "����´���";}else if($result['alcohol']=="1"){ echo "�´��� ����ԡ����";}else if($result['alcohol']=="2"){ echo "�����繤��駤���";}else if($result['alcohol']=="3"){ echo "�����繻�Ш�";}?>
  </span></td>
  <td colspan="2" valign="top"><span class="text3"><strong>�͡���ѧ���: </strong>
      <? if($result['exercise']=="0"){ echo "������͡���ѧ���";}else if($result['exercise']=="1"){ echo "�͡���ѧ��µ�ӡ���ࡳ��";}else if($result['exercise']=="2"){ echo "�͡���ѧ��µ��ࡳ��";}?>
  </span></td>
  </tr>
<tr>
  <td colspan="2" valign="top"><span class="text3"><strong>����ѵ��ä��Шӵ��: </strong>
      <? if($result['prawat']=="0"){ echo "������ä��Шӵ��";}
	  		else if($result['prawat']=="1"){  echo "�����ѹ���Ե�٧";}
			else if($result['prawat']=="2"){  echo "����ҹ";}
			else if($result['prawat']=="3"){  echo "�ä���������ʹ���ʹ";}
			else if($result['prawat']=="4"){  echo "��ѹ����ʹ�٧";}
			else if($result['prawat']=="5"){  echo "�ä����˹�������� 2 �ä����";}
			else if($result['prawat']=="6"){  echo "�ä��Шӵ������...".$result['congenital_disease'];}
			 ?>
  </span></td>
  <td colspan="2" valign="top"><span class="text3"><strong>����Ѻ����ѡ�ҷ�� : </strong>
      <? if($result['hospital']==""){ echo ""; }else if(($result['prawat']!="0" || $result['prawat']!="") && $result['hospital']==""){ echo "������к�";}else{ echo $result['hospital'];} ?>
  </span></td>
  <td colspan="2" valign="top"><span class="text3"><strong>����:</strong>
      <? if($result['hospitaldrugreact']=="0" || $result['hospitaldrugreact']==""){ echo "�������"; }else{
		$sql55 = "Select  drugreact From opcard  where hn = '".$result['hn']."' ";
		$result55 = mysql_query($sql55);
		$arr55 = mysql_fetch_array($result55);
			echo $arr55["drugreact"];
		}	
	?>
  </span></td>
</tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text31">
        <tr>
          <td width="61%" align="center" bgcolor="#CCCCCC">labcode </td>
          <td width="19%" align="center" bgcolor="#CCCCCC">result</td>
          <td width="20%" align="center" bgcolor="#CCCCCC">normalrange</td>
        </tr>
        <? $sql="SELECT * FROM result1 WHERE profilecode='CBC' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
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
          <td><?=$objResult["labcode"]." ".$labmean;?></td>
          <td align="center"><?=$objResult["result"];?></td>
          <td align="center"><?=$objResult["normalrange"];?></td>
        </tr>
        <?  } ?>
      
        <?
 		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
 ?>
        <tr>
          <td colspan="3"><span>�š�õ�Ǩ :</span><strong>
          <?=$result['cbc_lab']?>
          </strong></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <td align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>UA : ��õ�Ǩ��÷ӧҹ�ͧ�������</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text311">
        <tr>
          <td width="44%" align="center" bgcolor="#CCCCCC">labcode </td>
          <td width="15%" align="center" bgcolor="#CCCCCC">result</td>
          <td width="41%" align="center" bgcolor="#CCCCCC">normalrange</td>
        </tr>
        <? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
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
			}else if($objResult["labcode"]=="PROU"){
				$labmean="(�õչ㹻������)";
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
          <td><?=$objResult["labcode"]." ".$labmean;?></td>
          <td ><?=$objResult["result"];?></td>
          <td align="center"><?=$objResult["normalrange"];?></td>
        </tr>
        <?  } ?>
        <tr>
          <td colspan="3">�ŵ�Ǩ : <strong>
        <?=$result['ua_lab']?></strong></td>
        </tr>
      </table></td>
    </tr>
  </table>    </tr>
<tr>
  <td colspan="2" valign="top" class="text">
  <table width="100%"  bordercolor="#FFFFFF" border="0"  cellpadding="0" cellspacing="0">  
    <tr>
      <td valign="middle" class="text3"><strong>�š�õ�Ǩ&nbsp;</strong></td>
      <!--<td valign="top" width="4%"  class="text3" bordercolor="#000000"><strong>2555</strong></td>-->
      <td width="10%" align="right" valign="middle" bordercolor="#000000"  class="text3"><strong>result</strong></td>
      <td width="1%" align="center" valign="middle" bordercolor="#000000"  class="text3">&nbsp;</td>
      <td valign="middle" class="text">&nbsp;</td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <? if($result['glu_result']!=""){?>
    <tr>
      <td width="43%" valign="middle" class="text3"><strong>GLU(����ҹ) :</strong></td>
     <!-- <td width="4%" align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['bs']?>
      </strong></td>-->
        <td width="10%" align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['glu_result']?>
        </strong></td>
        <td width="1%" align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td width="18%" valign="middle" class="text"><strong>
          <?=$result['glu_lab']?>
        </strong></td>
        <td width="28%" valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['chol_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>CHOL(��õ�Ǩ��ѹ) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['chol']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['chol_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['chol_lab']?></strong>        </td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['trig_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>TRIG(��õ�Ǩ��ѹ) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['tg']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['trig_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['trig_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      
      
       <? 
	   }
	  if($result['hdl_result']!=""){
	  ?>     
      <tr>
        <td valign="middle" class="text3"><strong>HDL(��õ�Ǩ��ѹ��) :</strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['hdl_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong><strong>
          <?=$result['hdl_lab']?>
        </strong></strong></td>
        <td valign="middle" class="text">&nbsp;</td>
        </tr>

        
      <? } 
	  if($result['ldl_result']!=""){
	  ?>        
      <tr>
        <td valign="middle" class="text3"><strong>LDL(��õ�Ǩ��ѹ���) :</strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['ldl_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['ldl_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
        </tr>
        
        
      <? } 
	  if($result['bun_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>BUN(��÷ӧҹ�ͧ�) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['bun']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['bun_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['bun_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['crea_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>CREA(��÷ӧҹ�ͧ�) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['cr']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['crea_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['crea_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['alp_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>ALP(�Ѻ,��д١) :</strong></td>
     <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['alk']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['alp_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['alp_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['alt_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>ALT(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgpt']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['alt_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['alt_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <? } 
	  if($result['ast_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>AST(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgot']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['ast_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['ast_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <? } 
	  if($result['uric_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>URIC(�ä��ҷ�) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['uric']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['uric_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['uric_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top" style="line-height:1px;"> <hr /></td>
    </tr>
	<? }
	?>     
    <tr>
      <td valign="top" class="text3"><strong>��ҡ���Ѵ % ����˹ѧ :</strong></td>
      <td align="right" valign="top" class="text3"><strong>
        <?=$result['fat']." %";?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
      <td align="left" valign="top"><strong>
        <?
        if($result['result_fat']==1){
			echo "���";
		}else  if($result['result_fat']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_fat']==3){
			echo "����ǹ";
		}else  if($result['result_fat']==4){
			echo "��͹��ҧ��ǹ";
		}else  if($result['result_fat']==5){
			echo "��ǹ";
		}else{
			echo "����ռ�";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>�������ç�ͧ��������ʹ����Ѵ�ç�պ��� :</strong></td>
      <td align="right" valign="top" class="text3"><strong>
        <?=$result['hand2']." ��./��.";?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
      <td align="left" valign="top"><strong>
        <?
        if($result['result_hand']==1){
			echo "���";
		}else  if($result['result_hand']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_hand']==3){
			echo "����";
		}else  if($result['result_hand']==4){
			echo "��";
		}else  if($result['result_hand']==5){
			echo "���ҡ";
		}else{
			echo "����ռ�";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>�������ç�ͧ��������ʹ����ç����´�� :</strong></td>
      <td align="right" valign="top" class="text3"><strong>
        <?=$result['leg2']." ��./��.";?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
      <td align="left" valign="top"><strong>
        <?
        if($result['result_leg']==1){
			echo "���";
		}else  if($result['result_leg']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_leg']==3){
			echo "����";
		}else  if($result['result_leg']==4){
			echo "��";
		}else  if($result['result_leg']==5){
			echo "���ҡ";
		}else{
			echo "����ռ�";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>�������ç�ͧ�к��ҧ�Թ��������к�������¹���Ե :</strong></td>
      <td align="right" class="text3"><strong>
        <?=$result['steptest3']." ����/�ҷ�";?>
      </strong></td>
      <td align="left" class="text3">&nbsp;</td>
      <td align="left"><strong>
        <?
        if($result['result_steptest']==1){
			echo "���";
		}else  if($result['result_steptest']==2){
			echo "��͹��ҧ���";
		}else  if($result['result_steptest']==3){
			echo "����";
		}else  if($result['result_steptest']==4){
			echo "��";
		}else  if($result['result_steptest']==5){
			echo "���ҡ";
		}else{
			echo "����ռ�";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top" style="line-height:1px;"> <hr /></td>
    </tr> 
    <tr>
      <td valign="top" class="text3"><strong>CXR ��õ�Ǩ��硫�����ʹ :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3"><strong>
        <?=$result['xray']?>
        </strong>
          <? if($result['xray']=="�Դ����") echo "���й�...".$result['xray_detail']."...";?></td>
      </tr>
    <tr>
      <td colspan="6" align="center" valign="top" style="line-height:1px;"> <hr /></td>
    </tr>        
    <tr>
      <td valign="top" class="text3" width="43%"><strong>��õ�Ǩ�آ�Ҿ��ͧ�ҡ :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3"><strong><?=$result['dental_result'];?></strong></td>
      </tr>
    <tr>
      <td valign="top" class="text3"><strong>�ä�ѹ :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3"><strong>
        <?
        if($result['dental_disease1']==1){
			echo "�ѹ�� ";
		}
		if($result['dental_disease2']==1){
			echo " �ѹ�֡ ";
		}
		if($result['dental_disease3']==1){
			echo "�ä��Էѹ���ѡ�ʺ";
		}
		?>
      </strong></td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>�ä�˧�͡ :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3">
        <?
        if($result['gum_disease1']==1){
			echo "�ä�˧�͡�ѡ�ʺ ";
		}
		if($result['gum_disease2']==1){
			echo " �ѹ�ش";
		}
		?>      </td>
    </tr>
    <tr align="left">
      <td colspan="6" valign="top" ><hr /></td>
    </tr>
    <tr>
      <td height="27" colspan="6" align="center" class="text1">
        <strong>��ػ�š�õ�Ǩ�آ�Ҿ : </strong>
		<?
        if($result['resultdiag_normal']=="1"){
			echo "��辺��������§����ä NCDs";
		}
		if($result['resultdiag_risk']=="1"){
			echo "����������§���ͧ�鹵���ä ";
			if($result['risk_dm']=="1"){
				echo "DM ";
			}
			if($result['risk_ht']=="1"){
				echo " HT ";
			}
			if($result['risk_stroke']=="1"){
				echo " Stroke ";
			}			
			if($result['risk_obesity']=="1"){
				echo " Obesity";
			}			
		}
		if($result['resultdiag_diseases']=="1"){
			echo " ���´����ä������ѧ ";
			if($result['diseases_dm']=="1"){
				echo "DM ";
			}
			if($result['diseases_ht']=="1"){
				echo " HT ";
			}
			if($result['diseases_stroke']=="1"){
				echo " Stroke ";
			}			
			if($result['diseases_obesity']=="1"){
				echo " Obesity";
			}			
		}
		?>
      </td>
    </tr>    
</table>
</td>
</tr>
</table>
