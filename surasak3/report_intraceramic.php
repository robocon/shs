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
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
.textsub1 {	font-size: 16px;
}
-->
</style>
</head>

<body onload="document.getElementById("hn").focus();">
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">�����㺵�Ǩ�آ�Ҿ�Թ�������Ԥ</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
    <input name="hn" type="text" size="10" class="tet1" id="hn">
  <input type="submit" name="ok" value="��ŧ">
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


		
	$select2 = "select * from opcardchk  where HN='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$result2 = mysql_fetch_array($row2);

	
	
	$select = "select * from out_result_chkup  where hn='".$result2['HN']."'";
	
	
	$row = mysql_query($select)or die (mysql_error());
	$result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result2['HN']."' and clinicalinfo ='��Ǩ�آ�Ҿ�Թ�������Ԥ' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ�Թ�������Ԥ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 21 ���Ҥ� 2558</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"   class="text1" >
                <tr>
                  <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN : <?=$result['hn']?> 
                    &nbsp;&nbsp;</strong><strong>���� :</strong> <span style="font-size:24px"><strong>
                    <?=$result['ptname']?>
                    </strong></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ/��͹/�� �Դ</strong>
                    <?=$result2['dbirth']?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"  class="text1" >
                <tr>
                  <td width="588" valign="top"><strong class="text" style="font-size:20px"><u>��Ǩ��ҧ��·����</u></strong>&nbsp;&nbsp;<span class="text3"><strong>���˹ѡ: </strong>
                      <?=$result['weight']?>
&nbsp;��. <strong>��ǹ�٧:</strong>
<?=$result['height']?>
&nbsp;��. <strong>BMI: </strong> <u>
<?=$bmi?> </u><strong>BP:<u>
<?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg. </u></strong><span class="text3"><strong>P: </strong> <u>
                      <?=$result['p']?> &nbsp;����/�ҷ�
                  </u></span></span></td>
                </tr>
                <tr>
                  <td valign="top"><strong style="font-size:20px;">�ŵ�Ǩ : </strong><span style="font-size:16px;"> �Ѫ����š�� 
				  <?  if($bmi == '0.00' ){
				  			echo "'������Ѻ��õ�Ǩ";
						}
						 else if($bmi >= 18.5 && $bmi <= 22.99){
				  			
							echo "�չ��˹ѡ���ࡳ��";
							
						}else{
							if($bmi < 18.5){ echo "�չ��˹ѡ��ӡ���ࡳ��";}
							if($bmi >= 23 && $bmi <= 24.99){ echo "������չ��˹ѡ�Թࡳ��";}
							if($bmi >= 25 && $bmi <= 29.99){ echo "�չ��˹ѡ�Թࡳ��";}
							if($bmi >= 30 && $bmi <= 34.99){ echo "��������ǹ��͹��ҧ�ҡ";}
							if($bmi >= 35){ echo "��������ǹ�ҡ";}
						}

				 ?>
				/ �����ѹ���Ե  
                  <? if($result["bp1"] =='NO'){
							echo "������Ѻ��õ�Ǩ";
						}else  if($result["bp1"] <= 130){
							echo "����";
						}else{
							if($result["bp1"] >=140){ 
								echo "�դ����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ ��੾������÷�������������͡���ѧ���";
							}else if($result["bp1"] >=131 && $result["bp1"] < 140){
								echo "����������Ф����ѹ���Ե�٧ ��õ�Ǩ��������͡���ѧ������ҧ��������";
							}
						}
				  ?>
				  </span>
                  </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
  </tr>
  <tr>
    <td width="52%"  valign="top"><table width="100%" height="111" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
      <tr>
        <td height="33" align="center"><strong class="text" style="font-size:22px"><u>UA : ��õ�Ǩ��÷ӧҹ�ͧ�������</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
          <tr>
            <td width="53%" align="left" bgcolor="#CCCCCC"><strong>labcode </strong></td>
            <td width="17%" align="left" bgcolor="#CCCCCC"><strong>result</strong></td>
            <td width="30%" align="center" bgcolor="#CCCCCC"><strong>normalrange</strong></td>
          </tr>
<? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////

$strSQL1 = "SELECT authorisename, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'";
//echo "===>".$strSQL1."<br>";
$objQuery1 = mysql_query($strSQL1);
list($authorisename,$authorisedate)=mysql_fetch_array($objQuery1);


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		//echo $strSQL;
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
            <td><?=$objResult["labcode"]." ".$labmean;?></td>
            <td ><?=$objResult["result"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
          
          <?  } ?>        
          <tr>             
            <td height="27" colspan="3"><strong>�ŵ�Ǩ :</strong>              <? if($bloodvalue=="Negative" || $provalue=="Negative"){ echo "����";}else{ echo "�Դ���� ��õ�Ǩ������;�ᾷ�����������˵�";}?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top">
<? if($result['hn']!="58.128" && $result['hn']!="58.110" && $result['hn']!="58.109" && $result['hn']!="58.114" && $result['hn']!="58.115" && $result['hn']!="58.121" && $result['hn']!="58.129" && $result['hn']!="58.134"){?>  
<table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:20px"><u>LAB : ����</u></strong></td>
        </tr>
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" class="text3">
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
			
if($objResult["labcode"]=='GLU'){
	if($objResult["result"]>=74 && $objResult["result"]<=106){
		$app="�дѺ��ӵ������ʹ�����ࡳ�컡�� ��õ�Ǩ������� 1-3 ��";
	}else if($objResult["result"]<74){
		$app="�дѺ��ӵ������ʹ��ӡ��Ҥ�һ��� ��û�֡��ᾷ����е�Ǩ���� 3-6 ��͹";	
	}else if($objResult["result"]>106 && $objResult["result"]<=125){
		$app="�дѺ��ӵ������ʹ�٧�Թ��һ��� �դ�������§�٧��͡���Դ����ҹ�͹Ҥ� ���������鹤Ǻ�������èӾǡ����,�� ����÷�����ʪҵ���ҹ��е�Ǩ���� 1-2 �� ";
	}else if($objResult["result"]>125){
		$app="�Ҩ���ä����ҹ ��þ�ᾷ�����ͻ����Թ���������ѡ��";	
	}
}

if($objResult["labcode"]=='BUN'){
	if($objResult["result"]>18){
		$app="��÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"]>=7 && $objResult["result"]<=18){
		$app="��÷ӧҹ�ͧ�������дѺ��軡�� ��õԴ�����ӷء1��";	
	}else if($objResult["result"]<7 ){
		$app="��÷ӧҹ�ͧ䵵�ӡ��һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}
	
}

if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.3){
		$app="��÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"]>=0.6 && $objResult["result"]<=1.3){
		$app="��÷ӧҹ�ͧ�������дѺ��軡�� ��õԴ�����ӷء1��";	
	}else if($objResult["result"]<0.6){
		$app="��÷ӧҹ�ͧ䵵�ӡ��һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}
}

if($objResult["labcode"]=='URIC'){
	if($objResult["result"]>7.2){
		$app="�дѺ�ô���Ԥ�٧���һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"] >=2.6 && $objResult["result"] <=7.2){
		$app="�дѺ�ô���Ԥ������дѺ��軡�� ��õ�Ǩ��ӷء1��";	
	}else if($objResult["result"]<2.6){
		$app="�дѺ�ô���Ԥ��ӡ��һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}
}


if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="�дѺ��ѹ����ʹ�����дѺ���� ��õԴ�����ӷء1��";	
	}else	if($objResult["result"]>200){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ������硹��� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ����þ�ᾷ�������Ѻ��û����Թ���������ѡ��";	
	}
}

if($objResult["labcode"]=='TRIG'){
	if($objResult["result"]>=30 && $objResult["result"]<=150){
		$app="�дѺ��ѹ����ʹ�����дѺ���� ��õԴ�����ӷء1��";	
	}else	if($objResult["result"]>150 && $objResult["result"]<250){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>250){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ ��þ�ᾷ�����ͷӡ���ѡ��";	
	}else	if($objResult["result"]<30){
		$app="�дѺ��ѹ����ʹ�դ�ҵ�ӼԴ����";	
	}
}

if($objResult["labcode"]=='HDL'){
	if($objResult["result"]>=30 && $objResult["result"]<=75){
		$app="�дѺ��ѹ����ʹ�����дѺ����";	
	}else	if($objResult["result"]>75){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]<30){
		$app="�дѺ��ѹ����ʹ�դ�ҵ�ӼԴ����";	
	}
}

if($objResult["labcode"]=='10001'){
	if($objResult["result"]>=0 && $objResult["result"]<=137){
		$app="�дѺ��ѹ����ʹ�����дѺ����";	
	}else	if($objResult["result"]>137){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}
}

if($objResult["labcode"]=='AST'){  //SGOT
	if($objResult["result"]>=15 && $objResult["result"]<=37){
		$app="��÷ӧҹ�ͧ�Ѻ����";	
	}else	if($objResult["result"]>37){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}else	if($objResult["result"]<15){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}
}
if($objResult["labcode"]=='ALT'){  //SGPT
	if($objResult["result"]>=0 && $objResult["result"]<=50){
		$app="��÷ӧҹ�ͧ�Ѻ����";		
	}else{
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}
}

if($objResult["labcode"]=='ALP'){  //ALK
	if($objResult["result"]>=46 && $objResult["result"]<=116){
		$app="��÷ӧҹ�ͧ�Ѻ����";	
	}else	if($objResult["result"]>116){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}else	if($objResult["result"]<46){
		$app="��÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}
}
		?>
          <tr>
            <td width="30%"><?=$objResult["labname"]." ".$labmean;?></td>
            <td width="7%"><? if($objResult["flag"]!="N"){ echo "<strong>".$objResult["result"]."</strong>";}else{ echo $objResult["result"];}?></td>
            <td width="7%"><?=$objResult["normalrange"];?></td>
            <td width="56%" style="font-size:12px;"><?=$app;?></td>
            </tr>
          <? 
		  } 
		}
	?>
          </table>      
          </td>
        </tr>
      </table>
 	<? } ?>    
         <?
		$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$result2['HN']."' and row_id between 3981 and 4262";
		//echo $sqlchk;
		$querychk=mysql_query($sqlchk) or die (mysql_error());
		$arrnum=mysql_num_rows($querychk);
		$arr=mysql_fetch_array($querychk);	
		if($arrnum > 0){
		?>       
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">
        <tr>  
          <td><strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <strong><? if($arr["cxr"]==""){ echo "NORMAL (����)"; }else{ echo "�Դ����...".$arr["cxr"]; } ?> </strong></u></strong></td>
        </tr>
<!--        <tr>
          <td><strong class="text" style="font-size:18px">��ػ�š�õ�Ǩ/���йӢͧᾷ�� : </strong><span class="text" style="font-size:16px;"><?$arr["doctor_result"];?></span></td>
        </tr>-->
    </table>
    <?
	}
	?>
    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB : </strong><?=$authorisename?> <strong> (<?=$authorisedate?>) <span><strong> CXR : </strong>�.�.��Է��� ��ظҴ� (�.38228) �ѧ��ᾷ��<strong> (15-11-2015)</strong></span></strong><strong> Doctor : �.�.��ͻ�Ѫ�� �ѧ�á������ (�.32166) (20-11-2015)</strong></td>
    
  </tr>
</table>
<? } ?>
</body>
</html>