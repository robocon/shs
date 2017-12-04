<?php
session_start();
include("connect.inc");  

if(isset($_GET["del"])){
	
	$sql = "Delete From bring Where row_id = '".$_GET["id"]."' ";
	$result = Mysql_Query($sql);

	$sql = "Delete From bring_detail Where bring_id = '".$_GET["id"]."' ";
	$result = Mysql_Query($sql);

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=list_stkrx2.php\">";
exit();

}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> เบิกยาและเวชภัณฑ์ </TITLE>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 16 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

</HEAD>
<BODY>


<TABLE  border="1" bordercolor="#3366FF" align="center" width="550">
<TR>
	<TD>

<TABLE width="100%">
<TR align="center" bgcolor="#0033FF" style="color:#FFFFFF;">
	<TD>เลขที่ใบเบิก</TD>
	<TD>วันที่เบิก</TD>
	<TD>ผู้เบิก</TD>
	<TD>จำนวนรายการ</TD>
	<TD align="center">&nbsp;</TD>
</TR>


<?php
	
	//$sql = "Select row_id, bring_no, date_format(bring_date,'%d-%m-%Y') as bring_date , office From bring where office = '".$_SESSION["sIdname"]."' Order by row_id DESC  ";

	$sql = "Select row_id, bring_no, date_format(bring_date,'%d-%m-%Y') as bring_date , office From bring Order by row_id DESC  ";
	$result = Mysql_Query($sql);

while($arr = Mysql_fetch_assoc($result)){
	
	$sql2 = "Select count(row_id) From bring_detail Where bring_id = '".$arr["row_id"]."' ";
	$result2 = Mysql_Query($sql2);
	list($rows) = Mysql_fetch_row($result2);

 echo "
	<TR>
		<TD align=\"center\"><A HREF=\"list_stkrx3.php?id=",$arr["row_id"],"\" target=\"_blank\">",$arr["bring_no"],"</A></TD>
		<TD align=\"center\">",$arr["bring_date"],"</TD>
		<TD>",$arr["office"],"</TD>
		<TD align=\"right\">",$rows,"&nbsp;&nbsp;&nbsp;&nbsp;</TD>
		<TD align=\"center\"><A HREF=\"list_stkrx2.php?del=true&id=".$arr["row_id"]."\">ลบ</A></TD>
	</TR>
 ";
}

?>
</TABLE>
</TD>
</TR>
</TABLE>

</BODY>
</HTML>
<?php
include("unconnect.inc");
?>
