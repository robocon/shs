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
<body>
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF'];?>" method="post">
<center>
<span class="tet1">�����㺵�Ǩ�آ�Ҿ�ѡ�֡�������Ҫ����</span><br />
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
?>
<?
	include("connect.inc");	
	$sql="SELECT  a.course, a.branch, b.hn, b.ptname, b.weight, b.height, b.bp1, b.bp2, b.p FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE (b.hn='591507' || b.hn='591444' || b.hn='591155' || b.hn='591639')  order by a.row";
	echo $sql;
	$cquery=mysql_query($sql);
	$num=mysql_num_rows($cquery);
	while($result=mysql_fetch_array($cquery)){
		$ht = $result['height']/100;
		$bmi=number_format($result['weight'] /($ht*$ht),2);
?>
<div id="divprint">
<p></p><p></p>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ�ѡ�֡������ ���.��ҹ�� �ӻҧ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 9-10 ��͹ �ԧ�Ҥ� �.�. 2559</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"   class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN : <?=$result['hn'];?>&nbsp;&nbsp;���� : <?=$result['ptname'];?>&nbsp;&nbsp;<?=$result['course'];?>&nbsp;&nbsp;<?=$result['branch'];?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"  class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td width="588" valign="top"><strong class="text" style="font-size:20px"><u>��Ǩ��ҧ��·����</u></strong>&nbsp;&nbsp;<span class="text3"><strong>���˹ѡ: </strong>
              <?=$result['weight'];?>
          ��. <strong>��ǹ�٧:</strong>
          <?=$result['height'];?>
          ��. <strong>BMI: </strong> <u>
            <?=$bmi?>
            </u><strong>BP:<u>
              <?=$result['bp1'];?>
              /
              <?=$result['bp2'];?>
              mmHg. </u></strong><strong>P: </strong> <u>
                <?=$result['p'];?>
                ����/�ҷ� </u></span></td>
      </tr>
      <tr>
        <td valign="top"><strong style="font-size:20px;">�ŵ�Ǩ : </strong><span style="font-size:16px;"> �Ѫ����š��
          <? if($bmi == 'na'  ){
				  			echo "NA";
						}else if($bmi >= 18.5 && $bmi <= 22.99){
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
          <? if($result["bp1"]=='na'){
							echo "NA";
						}elseif($result["bp1"] <= 130){
							echo "����";
						}else{
							if($result["bp1"] >=140){ 
								echo "�դ����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ ��੾������÷�������������͡���ѧ���";
							}else if($result["bp1"] >=131 && $result["bp1"] < 140){
								echo "����������Ф����ѹ���Ե�٧ ��õ�Ǩ��������͡���ѧ������ҧ��������";
							}
						}
				  ?>
        </span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
<?
$sql="SELECT * FROM resulthead WHERE hn='".$result['hn']."' and profilecode='METAMP'";
$query = mysql_query($sql);
$arrresult = mysql_fetch_array($query);
	
$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
$result2= mysql_query($sql);
$arr2 = mysql_fetch_assoc($result2);	
$authorisename = $arr2["authorisename"];
$authorisedate  = $arr2["authorisedate2"];
$labcode  = $arr2["labcode"];
$labname  = $arr2["labname"];
//$result  = $arr2["result"];

?>    
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none;">
        <tr>
          <td align="center"><strong class="text" style="font-size:20px"><u>�š�õ�Ǩ</u></strong></td>
        </tr>
        <tr>
          <td><strong class="text" style="font-size:18px"><u>LAB </u>&nbsp;&nbsp;&nbsp;&nbsp;</u>Metamphetamine : &nbsp;<strong><?="Negative";?></strong> <? echo " (����)";?></strong></td>
        </tr>
        <tr>   
          <td>
          <? 
		 // echo $result["hn"];
		  if($result['hn']=="591008" || $result['hn']=="591023" || $result['hn']=="591053" || $result['hn']=="591143" || $result['hn']=="591153" || $result['hn']=="591215" || $result['hn']=="591248" || $result['hn']=="591253" || $result['hn']=="591260" || $result['hn']=="591288" || $result['hn']=="591317" || $result['hn']=="591327" || $result['hn']=="591348" || $result['hn']=="591354" || $result['hn']=="591357" || $result['hn']=="591444" || $result['hn']=="591550" || $result['hn']=="591613" || $result['hn']=="591620" || $result['hn']=="591674" || $result['hn']=="591681" || $result['hn']=="591693" || $result['hn']=="591696" || $result['hn']=="591710"){ ?>
          <strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <strong>�Դ����</strong></u></strong>
          <? }else{ ?>
          <strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <strong>����</strong></u></strong>
		  <? } ?>
          </td>
        </tr>
        <tr>
          
        </tr>
    </table>    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB : </strong><?="�.�.���� �ʧ�آ";?> <strong> (<?="10-08-2559";?>) CXR : </strong>�.�.��Է��� ��ظҴ� (�.38228) �ѧ��ᾷ��<strong> (15-09-2559) Doctor : </strong>�.�.��ͻ�Ѫ�� �ѧ�á������ (�.32166) <strong>(20-09-2559)</strong></td>
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