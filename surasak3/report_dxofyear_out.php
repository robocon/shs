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
.text31 {font-family: "TH SarabunPSK";
	font-size: 16px;
}
-->
</style>
<?
if(isset($_POST['hn'])){
	$select = "select * from opcard where idcard = '".$_POST['hn']."'";
	$row = mysql_query($select);
	$num = mysql_num_rows($row);
	if($num==0){
		$select = "select * from condxofyear_out where hn = '".$_POST['hn']."' order by thidate desc";
		$row = mysql_query($select);
		$num = mysql_num_rows($row);
	}else{
		$numn = mysql_fetch_array($row);
		$select = "select * from condxofyear_out where hn = '".$numn['hn']."' order by thidate desc";
		$row = mysql_query($select);
		$num = mysql_num_rows($row);
	}	
	if($num>0){
	?>
<a href ="../nindex.htm" >&lt;&lt; �����</a> , <a href ="report_dxofyear_out.php" >[ HN ���� ]</a>
<table width="485" border="1" cellpadding="0" cellspacing="0"><tr>
    <td width="101" align="center"><span class="tet">�ѹ����Ǩ</span></td>
    <td width="197" align="center"><span class="tet">����-ʡ��</span></td>
    <td width="37" align="center"><span class="tet">��</span></td>
    <td width="37" align="center">&nbsp;</td>
    <td width="53" align="center">&nbsp;</td>
    <td width="46" align="center">&nbsp;</td>
    <td width="46" align="center">&nbsp;</td>    
    </tr>
    <?
		$i=0;
		while($result = mysql_fetch_array($row)){
			if($i==1){
					$i=0;
					$bgcolor = "#FFFFA6";
				}else{
					$bgcolor = "#FFFFFF";
					$i=1;
				}
		?>
		<tr bgcolor=<?=$bgcolor?>><td><span class="tet">
		  <?=$result["thidate"]?>
		</span></td>
		  <td><span class="tet">
		  <?=$result["ptname"]?>
		  </span></td>
		  <td align="center"><span class="tet">
		    <?=$result["yearcheck"]?>
		  </span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear_out.php?id=<?=$result["row_id"]?>&chkyear=<?=$result["yearcheck"]?>" target="_blank">�����</a></span></td>
          <td align="center"><span class="tet"><a href="report_dxofyear_out.php?id=<?=$result["row_id"]?>&no&chkyear=<?=$result["yearcheck"]?>" target="_blank">�٢�����</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear_out.php?ids=<?=$result["row_id"]?>" target="_blank">Stricker</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear_out2014.php?id=<?=$result["row_id"]?>" target="_blank">OLD</a></span></td>
          
		</tr>
		<?
		}
	}else if($num==0){
	?>
<a href ="../nindex.htm" >&lt;&lt; �����</a> , <a href ="report_dxofyear_out.php" >[ HN ���� ]</a>
<table width="485" border="1" cellpadding="0" cellspacing="0"><tr>
    <td width="101" align="center"><span class="tet">�ѹ����Ǩ</span></td>
    <td width="197" align="center"><span class="tet">����-ʡ��</span></td>
    <td width="37" align="center"><span class="tet">��</span></td>
    <td width="37" align="center">&nbsp;</td>
    <td width="53" align="center">&nbsp;</td>
    <td width="46" align="center">&nbsp;</td>
    <td width="37" align="center">&nbsp;</td>
</tr>    
    <?
  		$select = "select * from condxofyear_so where hn = '".$_POST['hn']."' and statusdata='y' order by thidate desc";
		$row = mysql_query($select);      
		$i=0;	
		while($result = mysql_fetch_array($row)){
			if($i==1){
					$i=0;
					$bgcolor = "#FFFFA6";
				}else{
					$bgcolor = "#FFFFFF";
					$i=1;
				}
		?>
		<tr bgcolor=<?=$bgcolor?>><td><span class="tet">
		  <?=$result["thidate"]?>
		</span></td>
		  <td><span class="tet">
		  <?=$result["ptname"]?>
		  </span></td>
		  <td align="center"><span class="tet">
		    <?=$result["yearcheck"]?>
		  </span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear.php?id=<?=$result["row_id"]?>&chkyear=<?=$result["yearcheck"]?>" target="_blank">�����</a></span></td>
          <td align="center"><span class="tet"><a href="report_dxofyear.php?id=<?=$result["row_id"]?>&no&chkyear=<?=$result["yearcheck"]?>" target="_blank">�٢�����</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear.php?ids=<?=$result["row_id"]?>" target="_blank">Stricker</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear2013.php?id=<?=$result["row_id"]?>" target="_blank">OLD</a></span></td>
		</tr>
		<?
		}   
	}else{
		?>
        <meta content="1" http-equiv="refresh"  />
		<?
	}
	?>
</table>
<?
}elseif(isset($_GET['ids'])){
	$detail = "select * from condxofyear_out where row_id = '".$_GET['ids']."' ";
	$result = Mysql_Query($detail);
	$arrs = Mysql_fetch_assoc($result);
	?>
<script language="javascript">
		window.print();
	</script>
	<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
	<tr>
	  <td>�š�õ�Ǩ�آ�Ҿ��Шӻ�</td>
	  </tr>
	<tr>
		<td>���� : <?php echo $arrs["ptname"];?> HN :<?php echo $arrs["hn"];?></td>
	  </tr>
	<tr>
	  <td>�ѹ����Ǩ : <?php echo $arrs["thidate"];?></td>
	  </tr>
	  <tr>
		<td>�š�õ�Ǩ : 
		<?php 
		if($arrs["anemia"] =="" && $arrs["cirrhosis"] =="" && $arrs["hepatitis"] =="" && $arrs["cardiomegaly"] =="" && $arrs["allergy"] =="" && $arrs["gout"] =="" && $arrs["waistline"] =="" && $arrs["asthma"] =="" && $arrs["muscle"] =="" && $arrs["ihd"] =="" && $arrs["thyroid"] =="" && $arrs["heart"] =="" && $arrs["emphysema"] =="" && $arrs["herniated"] =="" && $arrs["conjunctivitis"] =="" && $arrs["cystitis"] =="" && $arrs["epilepsy"] =="" && $arrs["fracture"] =="" && $arrs["cardiac"] =="" && $arrs["spine"] =="" && $arrs["dermatitis"] =="" && $arrs["degeneration"] =="" && $arrs["alcoholic"] =="" && $arrs["copd"] =="" && $arrs["bph"] =="" && $arrs["kidney"] ==""  && $arrs["pterygium"]  =="" && $arrs["tonsil"]  =="" && $arrs["paralysis"]  =="" && $arrs["blood"]  =="" && $arrs["conanemia"]  ==""){
		echo "����";
		}else{
		echo "�������ä...";
			if($arrs["anemia"] =="Y"){
				echo "���Ե�ҧ, ";
			}
			if ($arrs["cirrhosis"] =="Y"){
				echo "�Ѻ��, ";
			}
			if($arrs["hepatitis"] =="Y"){
				echo "�ä�Ѻ�ѡ�ʺ, ";	
			}
			if($arrs["cardiomegaly"] =="Y"){
				echo "�����, ";
			}
			if($arrs["allergy"] =="Y"){
				echo "������, ";
			}
			if($arrs["gout"] =="Y"){
				echo "�ä��ҷ�, ";
			}
			if($arrs["waistline"] =="Y"){
				echo "�ͺ����Թ, ";
			}
			if($arrs["asthma"] =="Y"){
				echo "�ͺ�״, ";
			}
			if($arrs["muscle"] =="Y"){
				echo "����������ѡ�ʺ, ";	
			}
			if($arrs["ihd"] =="Y"){
				echo "�ä���㨢Ҵ���ʹ������ѧ, ";
			}
			if($arrs["thyroid"] =="Y"){
				echo "���´�, ";
			}
			if($arrs["heart"] =="Y"){
				echo "�ä����, ";
			}
			if($arrs["emphysema"] =="Y"){
				echo "�ا���觾ͧ, ";
			}
			if($arrs["herniated"] =="Y"){
				echo "��͹�ͧ��д١�Ѻ��鹻���ҷ, ";
			}
			if($arrs["conjunctivitis"] =="Y"){
				echo "����ͺص��ѡ�ʺ, ";
			}
			if($arrs["cystitis"] =="Y"){
				echo "�����л�������ѡ�ʺ, ";	
			}
			if($arrs["epilepsy"] =="Y"){
				echo "���ѡ, ";
			}
			if($arrs["fracture"] =="Y"){
				echo "��д١�ѡ����͹, ";
			}
			if($arrs["cardiac"] =="Y"){
				echo "�����鹼Դ�ѧ���, ";
			}
			if($arrs["spine"] =="Y"){
				echo "��д١�ѹ��ѧ (͡) ��, ";
			}
			if($arrs["dermatitis"] =="Y"){
				echo "���˹ѧ�ѡ�ʺ, ";
			}
			if($arrs["degeneration"] =="Y"){
				echo "������������, ";
			}
			if($arrs["alcoholic"] =="Y"){
				echo "�����Դ���Ԩҡ��š�����, ";
			}
			if($arrs["copd"] =="Y"){
				echo "COPD, ";
			}
			if($arrs["bph"] =="Y"){
				echo "BPH, ";	
			}
			if($arrs["kidney"] =="Y"){
				echo "䵼Դ����, ";
			}
			if($arrs["pterygium"] =="Y"){
				echo "�������, ";
			}
			if($arrs["tonsil"] =="Y"){
				echo "�����͹����, ";
			}
			if($arrs["paralysis"] =="Y"){
				echo "����ҵ�ա����/���, ";
			}
			if($arrs["blood"] =="Y"){
				echo "������ʹ�Դ����, ";
			}
			if($arrs["conanemia"] =="Y"){
				echo "���Ыմ";
			}
			if($arrs["ht"] =="Y"){
				echo "�����ѹ���Ե�٧";
			}			
		}
		?>
        
        </td>
	  </tr>
      <?
      	if($_POST['normal41']=="�Դ����"|$_POST['normal42']=="�Դ����"|$_POST['normal43']=="�Դ����") $text41="�Ѻ";
		if($_POST['normal44']=="�Դ����"|$_POST['normal45']=="�Դ����") $text44="�";
		if($_POST['normal46']=="�Դ����"|$_POST['normal48']=="�Դ����") $text46="��ѹ";
		if($_POST['normal47']=="�Դ����") $text47="����ҹ";
		if($_POST['normal49']=="�Դ����") $text49="URIC";
		if($_POST['normal81']=="�Դ����") $text81="CBC";
		if($_POST['normal']=="�Դ����") $text="UA";
	  ?>
	  <? if($arrs["summary"]=="�Դ����"){?>
	  <tr>
	    <td>Diag: <?=$arrs["diag"]?></td>
      </tr>
      <tr>
	    <td>�ѹ�֡�ҡᾷ��: <?=$arrs["dx"]?></td>
      </tr>
      <tr>
	    <td>�����Դ����: <?=$text41?> <?=$text44?> <?=$text46?> <?=$text47?> <?=$text49?> <?=$text81?> <?=$text?></td>
      </tr>
      <? }?>
	  <tr>
		<td>ᾷ�� : <?php echo $arrs["doctor"];?></td>
	  </tr>
</table>
<?
}elseif(isset($_GET['mid'])){
	$select = "select * from condxofyear_out where hn = '".$_GET['mid']."' and thidate like '".$_SESSION['pdate']."%' order by row_id desc limit 1";
	//echo $select;
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	?>
	<script>
		window.opener.location.href='dx_ofyear_manual.php';
    	window.location.href="report_dxofyear_out.php?id=<?=$result["row_id"]?>";
		
    </script>
	<?
}elseif(isset($_GET['id'])){
	
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
	$nPrefix2="25".$nPrefix;
////*runno ��Ǩ�آ�Ҿ*/////////

	//������ش
	$select = "select * from condxofyear_out where row_id='".$_GET['id']."'";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	
	//�ա�͹
	$select5 = "select * from condxofyear_out where hn='".$result['hn']."' and yearcheck='".($nPrefix2-1)."' order by row_id desc";
	$row5 = mysql_query($select5);
	$result5 = mysql_fetch_array($row5);
	if(!isset($_GET['no'])){
	?>
<script language="javascript">
		window.print();
	</script>
    <?
	}
	
$chkyear=substr($_GET["chkyear"],2);
//echo $chkyear;	
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='��Ǩ�آ�Ҿ��Шӻ�$chkyear' ";
$query1 = mysql_query($sql1); 	
	?>
<table width="100%">
<tr>
  <td colspan="2">
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
  <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ��Шӻ� <?=$nPrefix?></strong></td>
  <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
  <td align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 
  <?
  $da = explode(" ",$result["thidate"]);
  $daten = explode("-",$da[0]);
  ?>
    <?=$daten[2]?>-<?=$daten[1]?>-<?=$daten[0]?>&nbsp;<?=$da[1]?>
  </span></span></span></td>
  <td align="center" valign="top" class="text3">&nbsp;</td>
</tr>
</table></td></tr>
<tr>
  <td colspan="2" valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%" >
  <tr><td>
  <table width="100%" class="text1">
    <tr><td width="15%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="3" valign="top" class="text2"><strong>���� :</strong>    <span style="font-size:24px"><strong><?=$result['ptname']?></strong></span></td>
  <td valign="top" class="text2"><strong>���� :</strong>
    <?=$result['age']?></td>
  <td valign="top" class="text3"><strong>�ѧ�Ѵ : </strong>
    <span style="font-size:18px"><strong><?=$result['camp'];?></strong></span>  </td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>���˹ѡ: </strong>
  <?=$result['weight']?>��.</span></td>
  <td width="14%" valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
    <?=$result['height']?>
��.</span></td>
  <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong>
    <u><?=$result['bmi']?></u>
  </span></td>
  <td width="14%" valign="top"><span class="text3"><strong>�ͺ���:</strong>
    <?=$result['round_']?>
��.</span></td>
  <td width="19%" valign="top"><span class="text3"><strong>����:</strong> 
    <? if($result['drugreact']=="0" || $result['drugreact']==""){ echo "�������"; }else{
		$sql55 = "Select  drugreact From opcard  where hn = '".$result['hn']."' ";
		$result55 = mysql_query($sql55);
		$arr55 = mysql_fetch_array($result55);
			echo $arr55["drugreact"];
		}	
	?>
  </span></td>
  <td width="28%" valign="top"><span class="text3"><strong>�ä��Шӵ��:
  </strong>
    <? if($result['congenital_disease']=="") echo "�����"; else echo $result['congenital_disease']; ?>
  </span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>������: </strong>
    <? if($result['cigarette']=="0"){ echo "������ٺ";}else if($result['cigarette']=="1"){ echo "���ٺ ����ԡ����";}else if($result['cigarette']=="2"){ echo "�ٺ�繤��駤���";}else if($result['cigarette']=="3"){ echo "�ٺ�繻�Ш�";}?>
  </span></td>
  <td valign="top"><span class="text3"><strong>����: </strong>
    <? if($result['alcohol']=="0"){ echo "����´���";}else if($result['alcohol']=="1"){ echo "�´��� ����ԡ����";}else if($result['alcohol']=="2"){ echo "�����繤��駤���";}else if($result['alcohol']=="3"){ echo "�����繻�Ш�";}?>  
  </span></td>
  <td valign="top"><span class="text3"><strong>T:</strong>
<u><?=$result['temperature']?></u>
C �</span></td>
  <td valign="top"><span class="text3"><strong>P:
  </strong>
    <?=$result['pause']?>
����/�ҷ�</span></td>
  <td valign="top"><span class="text3"><strong>R: </strong>
    <?=$result['rate']?>
����/�ҷ�</span></td>
  <td valign="top"><span class="text3"><strong>BP:</strong>
    <u><?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg.</u></span></td>
</tr>
<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">��Ҥ����ѹ : </strong><?=$result['stat_pressure']?>
    <? if($result['stat_pressure']=="�Դ����") echo "���й�...".$result['reason_pressure']."...";?></td>
</tr>
<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">��� BMI : </strong>
    <?=$result['stat_bmi']?>
    <? if($result['stat_bmi']=="�Դ����") echo "���й�...".$result['reason_bmi']."...";?></td>
</tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <?
 		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
			
 ?>
          <tr>
            <td colspan="3"><strong>HCT &nbsp;: </strong><span class="text"><strong>
              <?=$result['stat_hct']?>
              </strong>
                  <? if($result['stat_hct']=="�Դ����") echo "���й�...".$result['reason_hct']."...";?>
            </span></td>
          </tr>
          <tr>
            <td colspan="3"><strong>WBC &nbsp;: </strong><span class="text"><strong>
              <?=$result['stat_wbc']?>
              </strong>
                  <? if($result['stat_wbc']=="�Դ����") echo "���й�...".$result['reason_wbc']."...";?>
            </span></td>
          </tr>
          <tr>
            <td colspan="3"><strong>PLTC : </strong><span class="text"><strong>
              <?=$result['stat_pltc']?>
              </strong>
                  <? if($result['stat_pltc']=="�Դ����") echo "���й�...".$result['reason_pltc']."...";?>
            </span></td>
          </tr>
          <tr>
            <td colspan="3"><span>�š�õ�Ǩ :</span><strong>
              <?=$result['stat_cbc']?>
              <? if($result['stat_cbc']=="�Դ����") echo "���й�...".$result['reason_cbc']."...";?>
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
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text31">
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
            <td height="27" colspan="3">�ŵ�Ǩ : <strong>
              <?=$result['stat_ua']?>
              <? if($result['stat_ua']=="�Դ����") echo "���й�...".$result['reason_ua']."...";?>
            </strong></td>
          </tr>
      </table></td>
    </tr>
  </table>    </tr>
<tr>
  <td colspan="2" valign="top" class="text">
  <table width="100%"  bordercolor="#FFFFFF" border="0"  cellpadding="0" cellspacing="0">
  
    <tr>
      <td valign="top" class="text3"><strong>�š�õ�Ǩ&nbsp;</strong></td>
      <!--<td valign="top" width="4%"  class="text3" bordercolor="#000000"><strong>2555</strong></td>-->
      <td width="4%" align="center" valign="top" bordercolor="#000000"  class="text3"><strong><?=$nPrefix2;?></strong></td>
      <td width="3%" align="center" valign="top" bordercolor="#000000"  class="text3">&nbsp;</td>
      <td valign="top" class="text">&nbsp;</td>
      <td valign="top" class="text">&nbsp;</td>
    </tr>
    <? if($result['bs']!=""){?>
    <tr>
      <td width="23%" valign="top" class="text3"><strong>GLU(����ҹ) :</strong></td>
     <!-- <td width="4%" align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['bs']?>
      </strong></td>-->
        <td width="4%" align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['bs']?>
        </strong></td>
        <td width="3%" align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td width="10%" valign="top" class="text">(<?=$result['bsrange']?>)</td>
        <td width="60%" valign="top" class="text"><strong>
          <?=$result['stat_bs']?>
        </strong>
          <? if($result['stat_bs']=="�Դ����") echo "���й�...".$result['reason_bs']."...";?></td>
      </tr>
      <? } 
	  if($result['chol']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>CHOL(��õ�Ǩ��ѹ) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['chol']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['chol']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['cholrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_chol']?>
        </strong>
          <? if($result['stat_chol']=="�Դ����") echo "���й�...".$result['reason_chol']."...";?></td>
      </tr>
      <? } 
	  if($result['tg']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>TRIG(��õ�Ǩ��ѹ) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['tg']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['tg']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['tgrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_tg']?>
        </strong>
          <? if($result['stat_tg']=="�Դ����") echo "���й�...".$result['reason_tg']."...";?></td>
      </tr>
      <? } 
	  if($result['bun']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>BUN(��÷ӧҹ�ͧ�) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['bun']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['bun']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['bunrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_bun']?>
        </strong>
          <? if($result['stat_bun']=="�Դ����") echo "���й�...".$result['reason_bun']."...";?></td>
      </tr>
      <? } 
	  if($result['cr']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>CREA(��÷ӧҹ�ͧ�) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['cr']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['cr']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['crrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_cr']?>
        </strong>
          <? if($result['stat_cr']=="�Դ����") echo "���й�...".$result['reason_cr']."...";?></td>
      </tr>
      <? } 
	  if($result['alk']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>ALP(��÷ӧҹ�ͧ�Ѻ,��д١) :</strong></td>
     <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['alk']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['alk']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['alkrange']?>)</td>
      <td valign="top" class="text"><strong><strong>
        <?=$result['stat_sgot']?>
      </strong></strong><? if($result['stat_sgot']=="�Դ����") echo "���й�...".$result['reason_sgot']."...";?></td>
      </tr>
      <? } 
	  if($result['sgpt']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>ALT(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgpt']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['sgpt']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['sgptrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_sgpt']?>
      </strong>
        <? if($result['stat_sgpt']=="�Դ����") echo "���й�...".$result['reason_sgpt']."...";?></td>
    </tr>
    <? } 
	  if($result['sgot']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>AST(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgot']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['sgot']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['sgotrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_alk']?>
      </strong>
        <? if($result['stat_alk']=="�Դ����") echo "���й�...".$result['reason_alk']."...";?></td>
    </tr>
    <? } 
	  if($result['uric']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>URIC(�ä��ҷ�) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['uric']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['uric']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['uricrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_uric']?>
      </strong>
        <? if($result['stat_uric']=="�Դ����") echo "���й�...".$result['reason_uric']."...";?></td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top"> <hr /></td>
    </tr>
	<? }
	?>
    
    <tr>
      <td valign="top" class="text3" width="23%"><strong>CXR ��õ�Ǩ��硫�����ʹ :</strong></td>
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
      <td width="23%" valign="top" class="text3"><strong>
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
	  
	 ?></u>      </td>
    </tr>
</table></td></tr>
    <tr>
  <td colspan="2" valign="top" class="text2"><? if(empty($result['diag'])){ echo "";}else{ echo "<strong>Diag</strong> : $result[diag] <strong >";}?> <strong>�����Դ��繨ҡᾷ��</strong>
&nbsp;<?=$result['dx']?></td>
  </tr>
  <?
  $dr =explode(" ",$result['doctor']);
  ?>
    <tr>
      <td colspan="2" align="right" valign="top" class="text2"><span class="text1">ᾷ�� <?=$result['doctor']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
    </tr>
</table>

<span class="text">
<?
}else{

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
	$nPrefix2="25".$nPrefix;
////*runno ��Ǩ�آ�Ҿ*/////////
?>
</span>
<!--<a href="report_dxofyear_emp.php">�����㺵�Ǩ�آ�Ҿ�١��ҧ</a>-->
<div>
	<a href="chk_sso.php" target="_blank">�����㺵�Ǩ�آ�Ҿ �Է����Сѹ�ѧ��</a>
</div>
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">�����㺵�Ǩ�آ�Ҿ��Шӻ� <?=$nPrefix2;?></span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
    <input name="hn" type="text" size="10" class="tet1" value="<?=$_GET["hn"];?>">
  &nbsp;&nbsp;
  <input name="ok" type="submit" class="texthead" value="��ŧ">
  <br />
  <br />

<a href ="../nindex.htm" >&lt;&lt; �����</a> 
</center>
</form>

<table border="1" width="30%" class="text1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
<?	
//	$Aquery = "select * from condxofyear_out where yearcheck='$nPrefix2' and printok='N' group by hn order by row_id desc";
	$rw = mysql_query($Aquery);
	while($fet = mysql_fetch_array($rw)){
		$Bquery = "select * from condxofyear_out where hn = '".$fet['hn']."' and  yearcheck='$nPrefix2' order by row_id desc";
		$rw2 = mysql_query($Bquery);
		$fet2 = mysql_fetch_array($rw2);
		?>
		<tr><td><a href="report_dxofyear_out.php?id=<?=$fet2["row_id"]?>" target="_blank"><?=$fet2['hn']?></a></td><td><?=$fet2['ptname']?></td></tr>
		<?
	}
	echo "</table>";
}
?>
