<?
session_start();
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
<title>�����š�û�Ժѵԧҹ��Ш��ѹ �ٹ�����������</title>
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
.style4 {font-weight: bold}
-->
</style>
</head>

<body>
<h21>
<table width="90%" border="0" align="center">
  <tr>
    <td colspan="2" align="center"><span class="style1">�����š�û�Ժѵԧҹ��Ш��ѹ </span></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>��ͧ���������� �ٹ�����������</strong></td>
  </tr>
  <tr>
    <td width="49%" align="left"><strong><a target="_self"  href='../nindex.htm'>&lt;&lt;�����&gt;&gt;</a></strong></td>
    <td width="51%" align="right">
	<?
    if($_SESSION["smenucode"]=="ADM"){
	?>
    	<a href="comservicereport.php" target="_self">��§ҹ��Ш���͹</a>  ||  
    	<a href="comservice.php" target="_self">�ѹ�֡������</a>
    <? 
	}else{
	?>
		<a href="comservicereport.php" target="_self">��§ҹ��Ш���͹</a>
	<?
    }	
	?>
    
    </td>
  </tr>
</table>
<?

$date=date("Y-m");
$sql="select * from comservice where datework like '2015-10%' or datework like '$date%' order by datework desc, timework desc";
//echo $sql;
$query=mysql_query($sql); 
$num=mysql_num_rows($query);           
?>
<table width="90%" border="0" align="center" cellpadding="0">
  <tr>
    <td width="4%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>�ӴѺ��� </strong></td>
    <td height="25" colspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>�ѹ��軯Ժѵԧҹ</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>Ἱ������ͧ��</strong></td>
    <td width="12%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>�������ͧ��</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>��黯Ժѵԧҹ</strong></td>
    <td width="43%" rowspan="2" align="center" bgcolor="#A7C941" class="style4"><strong>��������´�ҹ����</strong></td>
    <td width="7%" rowspan="2" align="center" bgcolor="#A7C941"><strong>��駧ҹ</strong></td>
  </tr>
  <tr>
    <td width="6%" height="25" align="center" bgcolor="#A7C941" class="style4"><strong>�ѹ/��͹/��</strong></td>
    <td width="7%" align="center" bgcolor="#A7C941" class="style4"><strong>����</strong></td>
  </tr>
  <?
if(empty($num)){
echo "
	<tr>
		<td colspan='6' align='center' bgcolor='#EBF2D3' class='style3'><--------------- ����բ�������к� ---------------></td>
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
    <td height="23" align="center" bgcolor="#EBF2D3"><?=$i;?></td>
    <td align="center" bgcolor="#EBF2D3"><?=$newdate;?></td>
    <td align="center" bgcolor="#EBF2D3"><?=$rows["timework"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["depart"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["personal"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["user"];?></td>
    <td align="left" bgcolor="#EBF2D3"><?=$rows["detail"];?></td>
    <td align="center" bgcolor="#EBF2D3"><a href="comserviceprint.php?id=<?=$rows["row_id"];?>" target="_blank">�����</a></td>
  </tr>
  <?
	}
}
?>
</table>
</body>
</html>
