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
	font-size: 20px;
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
<span class="tet1">�����㺵�Ǩ�آ�Ҿ����ѷ����Ե������Ԥ</span><br />
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
	$sql="SELECT  * FROM opcardchk  WHERE part='����Ե��60'  order by row";
	//echo $sql;
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
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ����ѷ����Ե������Ԥ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 21-25 ��͹ ����¹ �.�. 2560</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"   class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN : <?=$result['HN'];?>&nbsp;&nbsp;���� : <?=$result['name'];?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">   
    
<?
$sql1="SELECT * FROM resulthead WHERE hn='".$result['HN']."' and clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�60' and profilecode='XYLENE' order by autonumber desc";
//echo $sql1;
$query = mysql_query($sql1);
$arrresult = mysql_fetch_array($query);
	
$sql2 = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
//echo $sql2;
$result2= mysql_query($sql2);
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
          <td><strong class="text" style="font-size:18px"><u>�� LAB</u>&nbsp;&nbsp;&nbsp;</u>Xylene (��õ�Ǩ�������չ㹻������) : &nbsp;<?=$arr2["result"];?></strong></td>
        </tr>
        <tr>
          <td><strong class="text" style="font-size:18px">��ػ�š�õ�Ǩ : &nbsp;����</strong></td>
        </tr>        
        <tr>        </tr>
    </table>    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td width="50%" align="right"><strong>Authorise  LAB : </strong>
      <?=$authorisename;?>
      <strong> ( OUTLAB <?="04-05-2560";?>
)</strong></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td width="40%" class="text3">&nbsp;</td>
        <td width="13%" class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="40%" class="text3">&nbsp;</td>
        <td width="13%" class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" class="text3">��Ǩ�١��ͧ �.�.</td>
        <td class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td width="47%">&nbsp;</td>
        <td align="center" class="text3">(���Է�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ǧ�����)</td>
        <td class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" class="text3">&nbsp;ᾷ���Ш�þ.��������ѡ�������� �.�ӻҧ</td>
        <td class="text3">&nbsp;</td>
      </tr>
    </table></td>
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