<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>��¡�ä���ػ�ó��Ǫ�ѳ��</title>
</head>
<body>
��¡�ä���ػ�ó��Ǫ�ѳ��
<TABLE>
<TR align="center" bgcolor=6495ED>
	<TD>�Ǫ�ѳ��</TD>
	<TD>�ӹǹ</TD>
	<TD>�Ҥ����</TD>
	<TD>�ԡ��</TD>
</TR>
<?php
if(isset($_GET["id"])){

$sql = "Select detail,amount, price, yprice, nprice From patdata where idno = '".$_GET["id"]."'  ";
$result = Mysql_Query($sql);

while(list($detail,$amount, $price, $yprice, $nprice) = Mysql_fetch_row($result)){

echo "
<TR BGCOLOR=66CDAA>
	<TD>",$detail,"</TD>
	<TD>",$amount,"</TD>
	<TD>",$price,"</TD>
	<TD>",$yprice,"</TD>
</TR>";

}}
?>
</TABLE>


<?
include("unconnect.inc");
?>
</body>
</html>