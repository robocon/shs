<?
include("connect.inc");

function displaydate($x) {
	$thai_m=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�����š�û�Ժѵԧҹ <?=$_GET["user"];?></title>
<style type="text/css">
<!--
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {
	font-size: 22px;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>

<body>
<h21>
<table width="80%" border="0" align="center">
  <tr>
    <td align="center"><span class="style1">�����š�û�Ժѵԧҹ </span></td>
  </tr>
  <tr>
    <td align="center"><strong>���ͼ�黯Ժѵԧҹ : </strong><?=$_GET["user"];?>  <strong>��Ш��ѹ���</strong> : <?=displaydate($_GET["datework"]);?>      <strong><a target="_self"  href='../nindex.htm'></a></strong></td>
  </tr>
</table>
<?
$sql="select * from comservice where user ='$_GET[user]' and datework ='$_GET[datework]' order by timework asc";
$query=mysql_query($sql); 
$num=mysql_num_rows($query);           
?>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#3399CC" class="style4"><strong>�ӴѺ��� </strong></td>
    <td height="25" colspan="2" align="center" bgcolor="#3399CC" class="style4"><strong>�ѹ��軯Ժѵԧҹ</strong></td>
    <td width="14%" rowspan="2" align="center" bgcolor="#3399CC" class="style4"><strong>Ἱ������ͧ��</strong></td>
    <td width="14%" rowspan="2" align="center" bgcolor="#3399CC" class="style4"><strong>�������ͧ��</strong></td>
    <td width="15%" rowspan="2" align="center" bgcolor="#3399CC" class="style4"><strong>ʶҹ��軯Ժѵԧҹ</strong></td>
    <td width="51%" rowspan="2" align="center" bgcolor="#3399CC" class="style4"><strong>��������´�ҹ</strong></td>
  </tr>
  <tr>
    <td width="9%" height="25" align="center" bgcolor="#3399CC" class="style4"><strong>�ѹ/��͹/��</strong></td>
    <td width="6%" align="center" bgcolor="#3399CC" class="style4"><strong>����</strong></td>
  </tr>
  <?
if(empty($num)){
echo "
	<tr>
		<td colspan='5' align='center' bgcolor='#EBF2D3' class='style3'><--------------- ����բ�������к� ---------------></td>
	</tr>
";
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	$ited_request1=$rows["datework"];
	list($y,$m,$d)=explode("-",$ited_request1);
	$y=$y+543;
	$newdate="$d/$m/$y";	
?>
  <tr>
    <td height="23" align="center" bgcolor="#FFFFFF"><?=$i;?></td>
    <td align="center" bgcolor="#FFFFFF"><?=$newdate;?></td>
    <td align="center" bgcolor="#FFFFFF"><?=$rows["timework"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["depart"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["personal"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["location"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["detail"];?></td>
  </tr>
  <?
	}
}
?>
</table>
<p>&nbsp;</p>
<table width="80%" border="0" align="center">
  <tr>
    <td align="center"><strong>��Һ</strong>..........................................................</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
