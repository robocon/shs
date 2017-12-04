<?php
session_start();
include("connect.inc");
?>
<html>
<head>
<title>รายการค่าอุปกรณ์เวชภัณฑ์</title>
</head>
<body>
รายการค่าอุปกรณ์เวชภัณฑ์
<TABLE>
<TR align="center" bgcolor=6495ED>
	<TD>เวชภัณฑ์</TD>
	<TD>จำนวน</TD>
	<TD>ราคารวม</TD>
	<TD>เบิกได้</TD>
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