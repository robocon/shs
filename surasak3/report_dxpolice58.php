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
.textsub1 {
	font-size: 16px;
}
@media print{
#no_print{display:none;}
}
#divprint{ 
  page-break-after:always; 
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
  <input type="submit" name="ok" value="��ŧ" style="width:60px; height:40px; font:'TH SarabunPSK'; font-size:20px;">
  <br />
  <br />
</center>
</form>
</div>
<!--�ʴ�������-->
<? 
if(isset($_POST['ok'])){	
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
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}
	
	$select = "SELECT  a.row, a.exam_no, a.idcard, a.dbirth, a.agey, b.hn, b.ptname, b.weight, b.height, b.bp1, b.bp2, b.p, b.cxr FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part ='�ͺ���Ǩ58-2' order by b.row_id";
	//echo $select;	
	$row = mysql_query($select)or die (mysql_error());
	$num = mysql_num_rows($row);
	//echo $num;
	//$i=0;
	while($result=mysql_fetch_array($row)){
	//$i++;
	//echo "==>".$i;
	$dob=explode("/",$result['dbirth']);
	list($d,$m,$y)=$dob;
	$showdob="$y-$m-$d";
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	if($result['cxr']==""){
		$cxr="Normal";
	}else{
		$cxr=$result['cxr'];
	}
	
	//and clinicalinfo ='��Ǩ�آ�Ҿ���Ǩ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' ";
$query1 = mysql_query($sql1); 
?>
<div id="divprint">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ�ͺ����Ѻ�Ҫ��õ��Ǩ ˹��� �Ҥ 5</strong></td>
        </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        </tr>
      <tr>
        <td align="center" valign="top" class="text1">��Ǩ������ѹ���  25 �ѹ��¹ 2558</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"   class="text1" >
            <tr>
              <td colspan="2"  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ</u></strong></td>
            </tr>
            <tr>
              <td   valign="top" class="text2"><strong>HN :</strong> <strong>
                <?=$result['hn']?>
              </strong></td>
              <td  valign="top" class="text2"><strong>���� :</strong> <span style="font-size:24px"><strong>
                <?=$result['ptname']?>
              </strong></span></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text2"><span class="text3"><strong>�Ţ����ͺ : </strong></span><strong>
                <?=$result['exam_no']?>
                </strong>
                  <!--�ӴѺ�ͺ : <strong><?$result['row']?></strong><span class="text3"><strong>--></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  class="text1" >
            <tr>
              <td colspan="5" valign="top"><strong class="text" style="font-size:22px"><u>��Ǩ��ҧ��·����</u></strong></td>
            </tr>
            <tr>
              <td width="219" valign="top"><span class="text3"><strong>���˹ѡ: </strong>
                    <?=$result['weight']?>
                ��.</span></td>
              <td width="212"  valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
                    <?=$result['height']?>
                ��.</span></td>
              <td width="167" valign="top"><span class="text3"><strong>BMI: </strong> <u>
                <?=$bmi?>
              </u></span></td>
              <td width="346" valign="top"><span class="text3"><strong>BP:<u>
                <?=$result['bp1']?>
                /
                <?=$result['bp2']?>
                mmHg.</u></strong></span></td>
              <td width="199" valign="top"><span class="text3"><strong>P: </strong> <u>
                <?=$result['p']?>
                ����/�ҷ� </u></span></td>
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
            <td bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
 <? $sql="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and profilecode='CBC' and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
	//echo $sql;
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
            <td bgcolor="#CCCCCC">result</td>
            <td bgcolor="#CCCCCC">unit</td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and profilecode='UA' and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' ";
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
$sql="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and ( profilecode='METAMP' or profilecode='VDRL' or profilecode='HIV') and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' ";
//echo $sql."<br>";
	$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];

/*if($objResult["labcode"]=='VDRL'){
	
	$objResult["result"]='NON REACTIVE';
	
}else{
	$objResult["result"]='NEGATIVE';
}*/
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
           <?  } ?>

 
         
        </table></td>
      </tr>
    </table><div style="margin-top: 25px;"></div><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><strong class="text" style="font-size:22px"><u>X-RAY</u></strong></td>
        </tr>
        <tr>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            <tr>
               <td>CXR : <?=$cxr;?></td>
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
            
            </table>          </td>
        </tr>
    </table></td>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>STOOL: ��õ�Ǩ�ب���</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td bgcolor="#CCCCCC">result</td>
            <td bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and profilecode='STOOL' and clinicalinfo='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,'";
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
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
          <?  } ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<? 
$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
			$result2= mysql_query($sql);
	$arr2 = mysql_fetch_assoc($result2);	
		$authorisename = $arr2["authorisename"];
		$authorisedate  = $arr2["authorisedate2"];
?>
<table width="100%" border="0" class="text3">
  <tr>
    <td  width="50%" class="textsub1" align="center"><strong>LAB : Authorise name :</strong>      <?=$authorisename?> &nbsp;<strong>Authorise date :</strong><strong>
<?=$authorisedate?> CXR : </strong>�.�.��Է��� ��ظҴ� (�.38228) �ѧ��ᾷ��<strong> (01-10-2015)</strong></td>
    
  </tr>
 
</table>
</div>
<? 
	}
}
?>
<!--�Դ����ʴ�������-->
</body>
</html>