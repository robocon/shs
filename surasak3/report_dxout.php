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
<span class="tet1">�����㺵�Ǩ�آ�Ҿ���Ǩ</span> <br />
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
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }

		
	$select2 = "select * from opcardchk  where HN='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$result2 = mysql_fetch_array($row2);
	
	$subbirt=explode("/",$result2['dbirth']);
	$newdbirth=$subbirt[2]."-".$subbirt[1]."-".$subbirt[0];

	$age=calcage($newdbirth);
	
	$select = "select * from out_result_chkup  where hn='".$result2['HN']."'";
	
	
	$row = mysql_query($select)or die (mysql_error());
	$result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	//and clinicalinfo ='��Ǩ�آ�Ҿ���Ǩ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result2['HN']."' and clinicalinfo ='��Ǩ�آ�Ҿ������ҧ' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ���  6-7 ��Ȩԡ�¹ 2556</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"   class="text1" >
                <tr>
                  <td colspan="2"  valign="top" class="text2"><strong class="text" style="font-size:20px"><u>�����ŷ����</u></strong>&nbsp;&nbsp;<strong>HN :</strong>
                   <strong> <?=$result['hn']?></strong>
                &nbsp;&nbsp;<strong>���� :</strong> <span style="font-size:22px"><strong>
                    <?=$result['ptname']?>
                    </strong></span><strong>&nbsp;&nbsp;&nbsp;�ѹ/��͹/�� �Դ</strong>
                    <?=$result2['dbirth']?> <strong><br><strong>�Ţ��ЪҪ� : <strong>
                      <?=$result2['idcard']?>
                    </strong>
                      ���� :</strong>
                    <?=$age;?></td>
               </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table  class="text1" >
                <tr>
                  <td colspan="5" valign="top"><strong class="text" style="font-size:22px"><u>��Ǩ��ҧ��·����</u></strong></td>
                </tr>
                <tr>
                  <td width="113" valign="top"><span class="text3"><strong>���˹ѡ: </strong>
                    <?=$result['weight']?>
                    ��.</span></td>
                  <td width="109"  valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
                    <?=$result['height']?>
                    ��.</span></td>
                  <td width="118" valign="top"><span class="text3"><strong>BMI: </strong> <u>
                    <?=$bmi?>
                  </u></span></td>
                  <td width="130" valign="top"><span class="text3"><strong>BP:<u>
                    <?=$result['bp1']?>
                    /
                    <?=$result['bp2']?>

                    mmHg.</u></strong></span></td>

    <td width="118" valign="top"><span class="text3"><strong>P: </strong> <u>
                      <?=$result['p']?> ����/�ҷ�

                  </u></span></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top"><span class="text3">
				��Ҥ����ѹ:
                 <?
				if(($result['bp1'] <=129  &&  $result['bp2'] <=85)){ 
						$bp="�����ѹ���Ե�������"; 
				}else if(($result["bp1"] >129 && $result["bp1"] <=139) || ($result["bp2"]>80 && $result["bp2"] <= 89)){
					$bp="�����ѹ���Ե ��ͺ�٧ Pre-HT ��õ�ͧ�Ǻ����������੾�� ����÷�������������͡���ѧ���"; 
				}else if($result["bp1"] >=140 ||  $result["bp1"] <=90){
					$bp="�����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ��੾�� ����÷�������������͡���ѧ���";
				} else {$bp="�����ѹ���Ե�������"; }
				
				 
				echo $bp;
				?></span> </td>
                  </tr>
                <tr>
                  <td colspan="5" valign="top"><span class="text3">��� BMI : 
                  <? 
				  if($bmi<18.5){
					$showbmi="��ҹ�չ��˹ѡ�����Թ�";  
				  }else if($bmi>=18.5 && $bmi<23){
					$showbmi="��ҹ�չ��˹ѡ����";    
				  }else if($bmi>=23 && $bmi<25){
					$showbmi="��ҹ�����й��˹ѡ�Թ";  
			 	  }else if($bmi>=25 && $bmi<31){	 
				   $showbmi="��ҹ�չ��˹ѡ�Թ����������ǹ";  
				  }else if($bmi>=31 && $bmi<35){	
				  $showbmi="��ҹ��������ǹ�ع�ç��͹��ҧ�ҡ";
				  }else if($bmi>35){	  
				  	$showbmi="��ҹ��������ǹ�ع�ç";
				  }
				 echo $showbmi;
				 
				  ?>
                  </span>
                  </td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" class="text3">
          <tr>
            <td bgcolor="#CCCCCC">labcode </td>
            <td bgcolor="#CCCCCC">result</td>
            <td bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
            <td bgcolor="#CCCCCC">��ػ�š�õ�Ǩ</td>
            </tr>
          
          <?
$sql="SELECT * FROM result1 WHERE profilecode='GLU' or profilecode='CREA' or profilecode='CHOL' or profilecode='AST' or profilecode='ALT' ";
$query = mysql_query($sql);
while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

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
if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.4){
		$app="��ҡ�÷ӧҹ�ͧ��٧���Ҥ�һ��� ��þ�ᾷ�� �����Ѻ��û����Թ��С���ѡ��";	
	}else if($objResult["result"]<=1.4){
		$app="��ҡ�÷ӧҹ�ͧ�������дѺ����������������� ��õԴ�����ӷء1��";	
	}
}
if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="�дѺ��ѹ����ʹ�����дѺ���� ��õԴ�����ӷء1��";	
	}else	if($objResult["result"]>200){
		$app="�дѺ��ѹ����ʹ�դ�ҼԴ���� ��硹��� ��äǺ�������á������ѹ �͡���ѧ�����е�Ǩ���� 3-6 ��͹";	
	}else	if($objResult["result"]>300){
		$app="�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ����þ�ᾷ�������Ѻ��û����Թ���������ѡ��";	
	}
}
if($objResult["labcode"]=='AST'){
	if($objResult["result"]>40){
		$app="��ҡ�÷ӧҹ�ͧ�Ѻ �Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}else{
		$app="��ҡ�÷ӧҹ�ͧ�Ѻ ����";	
	}
}
if($objResult["labcode"]=='ALT'){
	if($objResult["result"]>50){
		$app="��ҡ�÷ӧҹ�ͧ�Ѻ �Դ���� ��þ�ᾷ�����ͻ����Թ����Ѻ����ѡ��";	
	}else{
		$app="��ҡ�÷ӧҹ�ͧ�Ѻ ����";	
	}
}

?>
          
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
            <td><?=$app;?></td>
            </tr>
          <?  } ?>
          
          
          </table></td>
      </tr>
      </table>
      <table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            <tr>
              <td>CXR : <strong>
                <?=$result['cxr']?>
                </strong></td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr class="text">
  
    <td  valign="top"><strong>LAB:Authorise name :</strong>
      <?=$authorisename?>
      &nbsp;&nbsp; <strong>Authorise date :</strong> <strong>
      <?=$authorisedate?>
    CXR:Authorise name :</strong>�.�.������ �زԸҴ� (�.33906) &nbsp;�ѧ��ᾷ��<strong>&nbsp;Authorise date :</strong><strong>10-11-2013</strong></td>
  </tr>
</table>


<? } ?>
</body>
</html>