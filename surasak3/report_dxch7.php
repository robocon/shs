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
div{
	height:2px;
}
</style>
</head>

<body>
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">�����㺵�Ǩ�آ�Ҿ��ѡ�ҹ��ͧ7</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
    <input name="hn" type="text" size="10" class="tet1">
  <input type="submit" name="ok" value="��ŧ">
  <br />
  <br />
  
</center>
</form>
</div>
<? 
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

if(isset($_POST['hn'])){
	
	include("connect.inc");

	$select = "select *,concat(address,' �.',tambol,' �.',ampur,' �.',changwat)as address,concat(yot,name,' ',surname)as ptname,date_format(dbirth,'%d-%m-%Y') as dbirth2 from opcard  where hn='".$_POST['hn']."'";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
		
/*	$select2 = "select *,date_format(dbirth,'%d-%m-%Y') as dbirth2 from opcardchk  where hn='".$result['hn']."'";
	$row2 = mysql_query($select2);
	$result2 = mysql_fetch_array($row2);*/
	

	
	
	//and clinicalinfo ='��Ǩ�آ�Ҿ���Ǩ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='��Ǩ�آ�Ҿ��ͧ7' and orderdate like '2013%' ";
$query1 = mysql_query($sql1); 

$str1="Select * from  result1 ";
$strquery1 = mysql_query($str1); 
$strar=mysql_fetch_assoc($strquery1);
$dateser=explode("-",substr($strar['orderdate'],0,10));

switch($dateser[1]){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}

$datesershow= $dateser[2].' '.$printmonth.'  '.($dateser[0]+543);




$opd="SELECT * FROM opd WHERE  hn  ='".$result['hn']."' ORDER BY `thidate` DESC limit 1 ";
$opdquery = mysql_query($opd)or die (mysql_error());
$opdarr=mysql_fetch_assoc($opdquery);

	$ht = $opdarr['height']/100;
	$bmi=number_format($opdarr['weight'] /($ht*$ht),2);

?>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ��ѡ�ҹʶҹ��÷�ȹ��աͧ�Ѿ����ͧ 7</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� <?=$datesershow;?> </span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table   class="text1" >
                <tr>
                  <td colspan="3"  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ</u></strong></td>
                </tr>
                <tr>
                  <td width="102"  valign="top" class="text2"><strong>HN :</strong>
                    <?=$result['hn']?></td>
                  <td width="202" valign="top" class="text2"><strong>���� :</strong> <span style="font-size:24px"><strong>
                    <?=$result['ptname']?>
                  </strong></span></td>
                  <td  width="300" valign="top" class="text3"><strong>�ѹ/��͹/�� �Դ</strong>
                    <?=$result['dbirth2']?> <strong>
���� :</strong>
                    <?=calcage($result['dbirth']);?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text2"><span class="text3"><strong>������� : </strong></span><strong>
                    <?=$result['address']?>
                  </strong></td>
                  <td valign="top" class="text2"><span class="text3"><strong>���Ѿ�� : <strong>
                 <?=$result['phone']?>
                  </strong></strong></span></td>
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
                    <?=$opdarr['weight']?>
                    ��.</span></td>
                  <td width="109"  valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
                    <?=$opdarr['height']?>
                    ��.</span></td>
                  <td width="118" valign="top"><span class="text3"><strong>BMI: </strong> <u>
                    <?=$bmi?>
                  </u></span></td>
                  <td width="130" valign="top"><span class="text3"><strong>BP:<u>
                    <?=$opdarr['bp1']?>
                    /
                    <?=$opdarr['bp2']?>

                    mmHg.</u></strong></span></td>

    <td width="118" valign="top"><span class="text3"><strong>P: </strong> <u>
                    <?=$opdarr['pause']?>

                  </u></span></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="50%"  valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>CBC : ��õ�Ǩ������ʹ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td align="center" bgcolor="#CCCCCC">result</td>
            <td align="center" bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='CBC' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
				if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td align="center"><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
                <?  } ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">�ŵ�Ǩ..����</td>
            </tr>
          
    
          
        </table></td>
        
      </tr>
    </table></td>
    <td width="50%"  valign="top"><table width="100%" border="1" style="border-collapse:collapse" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>UA : ��õ�Ǩ��÷ӧҹ�ͧ�������</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td align="center" bgcolor="#CCCCCC">result</td>
            <td align="center" bgcolor="#CCCCCC">unit</td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
			if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td ><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
          <?  } ?>
          <tr>
            <td colspan="4">�ŵ�Ǩ..���õչ����㹻������ �觺͡��÷ӧҹ�ͧ����ŧ</td>
            </tr>
          
          
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>LAB : ����</u></strong></td>
      </tr>
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" class="text3">
  
<? 
/*$sql="SELECT * FROM result1 WHERE profilecode='CHOL' or profilecode='TRIG' or profilecode='HDL' or profilecode='LDL' or profilecode='GLU' or profilecode='HBSAG' or profilecode='AST' or profilecode='ALT' or profilecode='ALP' or profilecode='URIC'";*/
$sql="SELECT * FROM result1 WHERE  profilecode='GLU' or profilecode='HBSAG' or profilecode='AST' or profilecode='ALT' or profilecode='ALP' or profilecode='URIC' or profilecode='BUN'  or profilecode='CREA'";
	$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

 /*$sql1="SELECT * FROM result1 WHERE profilecode='TRIG'";
	$query1 = mysql_query($sql1);
	$arrresult1 = mysql_fetch_array($query1);
/////
		$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult1['autonumber']."' ";
		$objQuery1 = mysql_query($strSQL1);
		$objResult1= mysql_fetch_array($objQuery1);

        
 $sql2="SELECT * FROM result1 WHERE profilecode='CHOL'";
	$query2 = mysql_query($sql1);
	$arrresult2 = mysql_fetch_array($query1);
/////
		$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult2['autonumber']."' ";
		$objQuery2 = mysql_query($strSQL2);
		$objResult2= mysql_fetch_array($objQuery2);*/
		
		if($objResult["labcode"]=='GLU' ){
		//	$ac='�٧���һ��� ��û�֡��ᾷ�� ����ͧ�����������ͻ�Ѻ������ҹ';
		
		$ac='�٧���Ҥ�һ�������Ѻ���������ҹ';
		}else{
			$ac='����';
		}
		?>
<tr>
<td width="36%" valign="top"><?=$objResult["labcode"];?> : <?=$objResult["result"];?></td>
<td width="64%" valign="top">�ŵ�Ǩ..<?=$ac;?></td>
</tr>
  <? } 
  if($result['hn']=='47-13413'){ 
	 $psa='0.551';
  }else if($result['hn']=='47-13411'){
	 $psa='0.541';
  }else if($result['hn']=='47-13582'){
	 $psa='0.690';
  }else if($result['hn']=='47-13420'){
	 $psa='1.566';
  }else if($result['hn']=='47-3875'){
	 $psa='0.633';
  }else if($result['hn']=='47-13421'){
	 $psa='0.805';
  }else if($result['hn']=='47-13417'){
	 $psa='0.721';
  }
 
  ?>
<tr>
<td  valign="top">PSA : <?=$psa;?></td>
<td  valign="top">�ŵ�Ǩ..����</td>
</tr>
        </table></td>
      </tr>
    </table></td>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>LIPID: ��õ�Ǩ�дѺ��ѹ����ʹ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td align="center" bgcolor="#CCCCCC">result</td>
            <td align="center" bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
<?
$sql="SELECT * FROM result1 WHERE profilecode='CHOL' or profilecode='TRIG' or profilecode='HDL' or profilecode='LDL' ";
	$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
           <?  } ?>
          <tr>
            <td colspan="4">�ŵ�Ǩ..�٧���һ���</td>
            </tr>
         
        </table></td>
      </tr>
    </table>
      <table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><strong class="text" style="font-size:22px"><u>X-RAY</u></strong></td>
        </tr>
        <tr>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            <tr>
              <td>CXR :  �����
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
</table>
<? 
/*$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
		$result2= mysql_query($sql);
		$arr2 = mysql_fetch_assoc($result2);	
		$authorisename = $arr2["authorisename"];
		$authorisedate  = $arr2["authorisedate2"];*/
?>
<table width="100%" border="0" class="text3">
  <tr>
    <td  width="50%"><strong>LAB:Authorise name :</strong>      <?=$authorisename?>      <span class="text3"><strong>Authorise date :</strong></span><strong>
<?=$authorisedate?>
    </strong></td>
    
  </tr>
  <tr>
    <td><strong>DOCTOR: Authorise name </strong>�.�.�Ԫ��� ��դسЫ���  (�.45992) <strong>Authorise date : 16-09-2013</strong></td>
  </tr>
  <!--<tr>
    <td><strong>CXR:Authorise name :</strong>�.�.������ �زԸҴ� �ѧ��ᾷ��<span class="text3"><strong>Authorise date :</strong><strong>12 �ѹ��¹ 2556 </strong></td>
    </tr>-->
</table>
<? } ?>
</body>
</html>