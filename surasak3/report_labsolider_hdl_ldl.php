<?php
session_start();
include("connect.inc"); 
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center">
<strong>��ª��ͷ��÷���Ǩ LAB ������� (HDL, LDL) �ҡ��ǹ����ԡ�����<strong></strong>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center" bgcolor="#FFCCCC"><strong>�ӴѺ</strong></td>
    <td width="20%" align="center" bgcolor="#FFCCCC"><strong>�ѹ/��͹/��</strong></td>
    <td width="10%" align="center" bgcolor="#FFCCCC"><strong>HN</strong></td>
    <td width="28%" align="center" bgcolor="#FFCCCC"><strong>���� - ���ʡ��</strong></td>
    <td width="26%" align="center" bgcolor="#FFCCCC"><strong>�ѧ�Ѵ</strong></td>
    <td width="10%" align="center" bgcolor="#FFCCCC"><strong>�ӹǹ�Թ</strong></td>
  </tr>
<?
$sql="select * from opacc where credit='HDLCHKUP59'";
$query=mysql_query($sql); 
$num=mysql_num_rows($query); 
if(empty($num)){
echo "
	<tr>
		<td colspan='6' align='center' bgcolor='#FFCC99'>---------------------- ����բ����� ----------------</td>
	</tr>
";
}   
$tables=0;	
while($rows=mysql_fetch_array($query)){
$tables++;
$total=$total+$rows["price"];
$sql1="select yot,ptname,camp from chkup_solider where hn='$rows[hn]' and yearchkup='59'";
$query1=mysql_query($sql1); 
list($yot,$ptname,$camp)=mysql_fetch_array($query1);
?>  
  <tr>
    <td height="30" align="center"><?=$tables;?></td>
    <td align="center"><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$yot." ".$ptname ;?></td>
    <td><?=$camp;?></td>
    <td align="right"><?=$rows["price"];?></td>
  </tr>
<?
}
?>  
<tr>
	<td align="right" colspan="5"><strong>���������</strong></td>
    <td align="right"><strong><?=number_format($total,2);?></strong></td>
</tr>
</table>
