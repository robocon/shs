<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.style1 {
	font-size: 20px;
	font-weight: bold;
}
.style2 {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
 include("connect.inc");  
////*runno ��Ǩ�آ�Ҿ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ��Ǩ�آ�Ҿ*/////////

if($_POST["chkmonth"]=="01"){
	$month="���Ҥ�";
}else if($_POST["chkmonth"]=="02"){
	$month="����Ҿѹ��";
}else if($_POST["chkmonth"]=="03"){
	$month="�չҤ�";
}else if($_POST["chkmonth"]=="04"){
	$month="����¹";
}else if($_POST["chkmonth"]=="05"){
	$month="����Ҥ�";
}else if($_POST["chkmonth"]=="06"){
	$month="�Զع�¹";
}else if($_POST["chkmonth"]=="07"){
	$month="�á�Ҥ�";
}else if($_POST["chkmonth"]=="08"){
	$month="�ԧ�Ҥ�";
}else if($_POST["chkmonth"]=="09"){
	$month="�ѹ��¹";
}else if($_POST["chkmonth"]=="10"){
	$month="���Ҥ�";
}else if($_POST["chkmonth"]=="11"){
	$month="��Ȩԡ�¹";
}else if($_POST["chkmonth"]=="12"){
	$month="�ѹ�Ҥ�";
}
?>
<div align="center" class="style1">�������µ�Ǩ�آ�Ҿ�ç����ѡ�ѹ������</div>
<div align="center">�ѹ��� <? echo $_POST["chkdate"]; ?> ��͹ <? echo $month; ?> �.�. <? echo $_POST["chkyear"]; ?></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" height="30" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>�ѹ/��͹/�</strong>�</td>
    <td width="12%" height="35" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="7%" height="35" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="29%" height="35" align="center" bgcolor="#66CC99"><strong>���� - ���ʡ��</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>LAB</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>X-RAY</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>���</strong></td>
  </tr>
<?
$sql="select * from opacc where credit = '�ѡ�ѹ������$nPrefix' and date like '$_POST[chkyear]-$_POST[chkmonth]-$_POST[chkdate]%' group by hn";
//echo $sql;
$query=mysql_query($sql);
$i=0;
$sumlab=0;
$sumxray=0;
$total=0;
while($rows=mysql_fetch_array($query)){
$i++;
$subdate=substr($rows["date"],0,10);
list($y,$m,$d)=explode("-",$subdate);
$showdate="$d/$m/$y";
$y=$y-543;
$newdate="$y-$m-$d";

$sql1="select vn, ptname from condxofyear_out where hn='$rows[hn]' and thidate like '$newdate%'";
$query1=mysql_query($sql1);
list($vn,$ptname)=mysql_fetch_array($query1);

$sql2="select price from opacc where depart='PATHO' and hn='$rows[hn]' and date like '$subdate%'";
$query2=mysql_query($sql2);
list($lab)=mysql_fetch_array($query2);

$sql3="select price from opacc where depart='XRAY' and hn='$rows[hn]' and date like '$subdate%'";
$query3=mysql_query($sql3);
list($xray)=mysql_fetch_array($query3);

$sum=$lab+$xray;
$sumlab=$sumlab+$lab;
$sumxray=$sumxray+$xray;
$total=$total+$sum;
?>  
  <tr>
    <td height="30" align="center"><?=$i;?></td>
    <td align="center"><?=$showdate?></td>
    <td height="35" align="center"><?=$rows["hn"];?></td>    
    <td height="35" align="center"><?=$vn;?></td>
    <td height="35" align="left"><?=$ptname;?></td>
    <td align="right"><?=number_format($lab,2);?></td>
    <td align="right"><?=number_format($xray,2);?></td>
    <td align="right"><?=number_format($sum,2);?></td>
  </tr>
<?
}
?>    
  <tr>
    <td height="35" colspan="5" align="right"><strong>���������</strong></td>
    <td align="right"><?=number_format($sumlab,2);?></td>
    <td align="right"><?=number_format($sumxray,2);?></td>
    <td align="right"><?=number_format($total,2);?></td>
  </tr>
</table>