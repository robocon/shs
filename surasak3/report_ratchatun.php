<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�����㺵�Ǩ�آ�Ҿ����ͧ�ѧ �Ҫ�ѳ���ӻҧ</title>
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
<span class="tet1">�����㺵�Ǩ�آ�Ҿ����ͧ�ѧ �Ҫ�ѳ���ӻҧ</span><br />
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
	$sql="SELECT  * FROM opcardchk  WHERE part='�Ҫ�ѳ��59' order by row limit 800,100";
	//echo $sql;
	$cquery=mysql_query($sql);
	$num=mysql_num_rows($cquery);
	while($result=mysql_fetch_array($cquery)){
	
	$sql1="select cxr from out_result_chkup where hn='".$result["HN"]."' and part='�Ҫ�ѳ��59'";
	$query1=mysql_query($sql1);
	list($cxr)=mysql_fetch_array($query1);
?>
<div id="divprint">
<p></p><p></p>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ����ͧ�ѧ �Ҫ�ѳ���ӻҧ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ��� 26 ��͹ �ѹ�Ҥ� �.�. 2559</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"   class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>�����ż���Ǩ�آ�Ҿ </u></strong> <strong>&nbsp;&nbsp;�ӴѺ : <?=$result['pid'];?>&nbsp;&nbsp;HN : <?=$result['HN'];?>&nbsp;&nbsp;���� : <?=$result['name'];?>&nbsp;&nbsp;<?=$result['surname'];?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none;">
        <tr>
          <td align="center" class="text1"><u><strong>�š�õ�Ǩ</strong></u></td>
        </tr>
        <tr>   
          <td>
          <strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <strong><? if(empty($cxr)){ echo "����";}else{ echo "�Դ����...".$cxr;}?></strong></u></strong>
          </td>
        </tr>
        <tr>
          
        </tr>
    </table>    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>CXR : </strong>�.�.��Է��� ��ظҴ� (�.38228) �ѧ��ᾷ��<strong> (20-01-2560) Doctor : </strong>�.�.���Է�� ǧ����� (�.27035) <strong>(27-01-2560)</strong></td>
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