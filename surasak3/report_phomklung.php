<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
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
	font-size: 16px;
}
.text4 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
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
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
</head>

<body onload="document.getElementById("hn").focus();">
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">�����㺵�Ǩ�آ�Ҿ������ѧ 58</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
  <input name="hn" type="text" size="10" class="tet1" id="hn">
  &nbsp;  
  <input type="submit" name="ok" value="  ��ŧ  " class="pdxhead"/>
  <br />
  <br />
  
</center>
</form>
</div>
<? 
if(isset($_POST['hn'])){
	
	?>
    <script>
	window.print() 
	</script>
    <?
	
	include("connect.inc");


		
	$select2 = "select * from opcardchk  where HN='".$_POST['hn']."' AND part='������ѧ58' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$result = mysql_fetch_array($row2);
	$ptname=$result["yot"]." ".$result["name"]." ".$result["surname"];

	
	//and clinicalinfo ='��Ǩ�آ�Ҿ���Ǩ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['HN']."' and clinicalinfo ='��Ǩ�آ�Ҿ������ѧ58' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="4" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="96" height="129" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>����ѷ ������ѧ �ӡѴ<br />
          ����ѷ �Ӿ�ѧ �ӡѴ<br />
          ����ѷ ��຿����è �ӡѴ</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 13 ���Ҥ� 2557</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"   class="text1" >
            <tr>
              <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN :
                <?=$result['HN']?>
                &nbsp;&nbsp;</strong><strong>���� :</strong> <span style="font-size:24px"><strong>
                  <?=$ptname;?>
                </strong></span></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="61%" align="center" bgcolor="#CCCCCC"><strong>labcode </strong></td>
            <td width="19%" align="center" bgcolor="#CCCCCC"><strong>result</strong></td>
            <td width="20%" align="center" bgcolor="#CCCCCC"><strong>normalrange</strong></td>
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
            <td height="27" colspan="3"><strong>�ŵ�Ǩ :</strong> <? while($objResult = mysql_fetch_array($objQuery)){
																			 if($objResult["labcode"]=="WBC"){
																						if($objResult["result"] >= 5.0 && $objResult["result"] <= 10.0){
																							$chkwbc = "����";
																						}else{
																							if($objResult["result"] < 5.0){
																								$chkwbc = "�Դ���� ���дѺ������ʹ��ǵ�ӡ��һ��� ��õ�Ǩ��� ���� ��ᾷ�����������˵�";
																							}else if($objResult["result"] > 10.0){
																								$chkwbc = "�Դ���� ���дѺ������ʹ����٧���һ��� ��õ�Ǩ��� ���� ��ᾷ�����������˵�";
																							}
																						}
																					}
																					
																					if($objResult["labcode"]=="HCT"){
																						if($objResult["result"] >= 35 && $objResult["result"] <= 51){
																							$chkhct = "����";
																						}else{
																							if($objResult["result"] < 35){
																								$chkhct = "�Դ���� ���дѺ������ʹᴧ��ӡ��һ��� �觺͡�֧���Ыմ��õ�Ǩ��� ���� ��ᾷ�����������˵�";
																							}else if($objResult["result"] > 51){
																								$chkhct = "�Դ���� ���дѺ������ʹᴧ�٧���һ��� ��õ�Ǩ��� ���� ��ᾷ�����������˵�";
																							}
																						}
																					}
																					
																					if($objResult["labcode"]=="PLTC"){
																						if($objResult["result"] >= 140 && $objResult["result"] <= 400){
																							$chkpltc = "����";
																						}else{
																							if($objResult["result"] < 140){
																								$chkpltc = "�Դ���� ����ҳ������ʹ�դ�ҵ�ӡ��һ��� ��õ�Ǩ��� ���� ��ᾷ�����������˵�";
																							}else if($objResult["result"] > 400){
																								$chkpltc = "�Դ���� ����ҳ������ʹ�դ���٧�Թ���� ��õ�Ǩ��� ���� ��ᾷ�����������˵�";
																							}
																						}
																					}
																	
																			
																			 if($objResult["labcode"]=="EOS"){
																						if($objResult["result"] >= 0 && $objResult["result"] <= 5.0){
																							$chkeos = "����";
																						}else{
																							if($objResult["result"] > 5.0){
																								$chkeos = "�Դ���� EOS �٧ ��õ�Ǩ���/��ᾷ��";
																							}
																						}
																					}
																					
			}
			
		
			
	if($chkwbc=="����" && $chkhct=="����" && $chkpltc=="����"&& $chkeos=="����"){	
	
		if($objResult['flag']=='L' || $objResult['flag']=='H'){
			   echo "��õ�Ǩ������;�ᾷ��";			}else{																																		
																						echo "����";		}
																				
																				
																				}
																				
																				
																				else{
																						if($chkwbc=="����"){
																							echo "";
																						}else{
																							echo $chkwbc.", ";
																						}
																						
																						if($chkhct=="����"){
																							echo "";
																						}else{
																							echo $chkhct.", ";
																						}
																						
																						if($chkpltc=="����"){
																							echo "";
																						}else{
																							echo $chkpltc;
																						}	
																						if($chkeos=="����"){
																							echo "";
																						}else{
																							echo $chkeos;
																						}																						
																				}
																				
																			
																		?>            </td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td height="34" align="center"><strong class="text" style="font-size:22px"><u>LAB : ����</u></strong></td>
      </tr>
      <tr>
        <td height="52" valign="top"><table width="100%" border="0" class="text3">
            <? /*$sql="SELECT * FROM result1 WHERE profilecode='METAMP'";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////
		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		$objResult = mysql_fetch_array($objQuery);

$sql1="SELECT * FROM result1 WHERE profilecode='VDRL'";
	$query1 = mysql_query($sql1);
	$arrresult1 = mysql_fetch_array($query1);
/////
		$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult1['autonumber']."' ";
		$objQuery1 = mysql_query($strSQL1);
		$objResult1= mysql_fetch_array($objQuery1);

$sql2="SELECT * FROM result1 WHERE profilecode='HIV'";
	$query2 = mysql_query($sql1);
	$arrresult2 = mysql_fetch_array($query1);
/////
		$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult2['autonumber']."' ";
		$objQuery2 = mysql_query($strSQL2);*/
?>
            <?
$sql="SELECT * FROM result1 WHERE profilecode='GLU' or profilecode='CREA' or profilecode='BUN' or profilecode='URIC' or profilecode='CHOL' or profilecode='TRIG' or  profilecode='AST' or profilecode='ALT' or profilecode='LIPID' or profilecode='ALP'";
$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){
		

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";

$objQuery = mysql_query($strSQL);

while($objResult = mysql_fetch_array($objQuery)){
			if($objResult["labname"]=="Blood Sugar"){
				$labmean="(�дѺ��ӵ������ʹ)";
					}else if($objResult["labname"]=="BUN"){
				$labmean="(��÷ӧҹ�ͧ�)";
			}else if($objResult["labname"]=="Creatinine"){
				$labmean="(��÷ӧҹ�ͧ�)";
		
			}else if($objResult["labname"]=="Uric acid"){
				$labmean="(���Ԥ����ʹ)";
			}else if($objResult["labname"]=="Cholesterol"){
				$labmean="(��ѹ����ʹ)";
			}else if($objResult["labname"]=="Triglyceride"){
				$labmean="(��ѹ����ʹ)";
			}else if($objResult["labname"]=="HDL"){
				$labmean="(��ѹ��)";			
			}else if($objResult["labname"]=="LDLC"){
				$labmean="(��ѹ���)";												
			}else if($objResult["labname"]=="SGOT(AST)"){
				$labmean="(��÷ӧҹ�ͧ�Ѻ)";
			}else if($objResult["labname"]=="SGPT(ALT)"){
				$labmean="(��÷ӧҹ�ͧ�Ѻ)";
			}else if($objResult["labname"]=="Alkaline phosphatase"){
				$labmean="(��÷ӧҹ�ͧ�Ѻ)";
			}
			

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];


if($objResult["labcode"]=='GLU'){
	if($objResult["result"]<110){
		$app="�дѺ��ӵ������ʹ�����ࡳ�컡�� ��õ�Ǩ������� 1-3 ��";
	}else if($objResult["result"]>=110 && $objResult["result"]<=125){
		$app="�дѺ��ӵ������ʹ�٧�Թ��һ��� �դ�������§�٧��͡���Դ����ҹ�͹Ҥ� ���������鹤Ǻ�������èӾǡ����,�� ����÷�����ʪҵ���ҹ��е�Ǩ���� 1-2 �� ";
	}else if($objResult["result"]>=126){
		$app="�Ҩ���ä����ҹ ��þ�ᾷ�����ͻ����Թ���������ѡ��";	
	}
}

if($objResult["labcode"]=='BUN'){
	if($objResult["result"]>21){
		$app="��÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"]<=21 ){
		$app="��÷ӧҹ�ͧ�������дѺ��軡�� ��õԴ�����ӷء1��";	
	
	}
}

if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>=1.4){
		$app="��÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"]<=1.3){
		$app="��÷ӧҹ�ͧ�������дѺ��軡�� ��õԴ�����ӷء1��";	
	}
}

if($objResult["labcode"]=='URIC'){
	if($objResult["result"]>7.0){
		$app="�дѺ�ô���Ԥ�٧���һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"]<=7.0){
		$app="�дѺ�ô���Ԥ������дѺ��軡�� ��õ�Ǩ��ӷء1��";	
	}
}


if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="�дѺ��ѹ����ʹ�����дѺ���� ��õԴ�����ӷء1��";	
	}else	if($objResult["result"]>200 && $objResult["result"]<300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ������硹��� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��";	
	}
}

if($objResult["labcode"]=='TRIG'){
	if($objResult["result"]>=30 && $objResult["result"]<=135){
		$app="�дѺ��ѹ����ʹ�����дѺ���� ��õԴ�����ӷء1��";	
	}else	if($objResult["result"]>135 && $objResult["result"]<300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}else	if($objResult["result"]<30){
		$app="�дѺ��ѹ����ʹ�դ�ҵ�ӼԴ����";	
	}
}

if($objResult["labcode"]=='HDL'){
	if($objResult["result"]>=30 && $objResult["result"]<=75){
		$app="�дѺ��ѹ����ʹ�����дѺ����";	
	}else	if($objResult["result"]>75 && $objResult["result"]<300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";			
	}else	if($objResult["result"]<30){
		$app="�дѺ��ѹ����ʹ�դ�ҵ�ӼԴ����";	
	}
}

if($objResult["labcode"]=='LDL'){
	if($objResult["result"]>=0 && $objResult["result"]<=137){
		$app="�дѺ��ѹ����ʹ�����дѺ����";	
	}else	if($objResult["result"]>137 && $objResult["result"]<300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";			
	}
}

if($objResult["labcode"]=='10001'){
	if($objResult["result"]>=0 && $objResult["result"]<=137){
		$app="�дѺ��ѹ����ʹ�����дѺ����";	
	}else	if($objResult["result"]>137 && $objResult["result"]<300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";			
	}
}

if($objResult["labcode"]=='AST'){
	if($objResult["result"]>=0 && $objResult["result"]<=40){
		$app="��÷ӧҹ�ͧ�Ѻ����";		
	}else{
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}
}
if($objResult["labcode"]=='ALT'){
	if($objResult["result"]>=0 && $objResult["result"]<=50){
		$app="��÷ӧҹ�ͧ�Ѻ����";		
	}else{
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}
}

if($objResult["labcode"]=='ALP'){
	if($objResult["result"]>=34 && $objResult["result"]<=123){
		$app="��÷ӧҹ�ͧ�Ѻ����";	
	}else	if($objResult["result"]>123){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}else	if($objResult["result"]<34){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}
}
		?>
            <tr>
              <td width="34%" valign="top"><?=$objResult["labname"]." ".$labmean;?></td>
              <td width="7%" valign="top"><?=$objResult["result"];?></td>
              <td width="10%" valign="top"><?=$objResult["normalrange"];?></td>
              <td width="49%" valign="top" style="font-size:14px;"><?=$app;?></td>
            </tr>
            <? 
		  } 
		}
	?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">
        <tr>
        <?
		$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$result['HN']."'";
		//echo $sqlchk;
		$querychk=mysql_query($sqlchk) or die (mysql_error());
		$arr=mysql_fetch_array($querychk);	
		?>            
          <td><strong class="text" style="font-size:18px">��ػ�š�õ�Ǩ/���йӢͧᾷ�� : </strong><span class="text" style="font-size:16px;"><?=$arr["doctor_result"];?></span></td>
        </tr>
    </table></td>
  </tr>
</table>
<? 
/*$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
$result2= mysql_query($sql);
$arr2 = mysql_fetch_assoc($result2);	
$authorisename = $arr2["authorisename"];
$authorisedate  = $arr2["authorisedate2"];*/
?>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB:</strong><?=$authorisename?> <strong> (<?=$authorisedate?>
    ) </strong><strong>Doctor :�.�.��ͻ�Ѫ�� �ѧ�á������ (22-10-2014)</strong></td>
    
  </tr>
</table>
<? } ?>
</body>
</html>