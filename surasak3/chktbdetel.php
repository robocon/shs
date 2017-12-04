<?php
include("connect.inc");

$ex_code = urldecode($_GET["toborow"]);

$sql = "Select hn, ptname, idcard, ptright From opday where thidate like '".$_GET["today"]."%' AND toborow = '".$ex_code."' ";
$result = Mysql_Query($sql);
?>
<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
<TABLE>
<TR align="center" bgcolor=6495ED>
	<TD><font face='Angsana New'>No.</font></TD>
	<TD><font face='Angsana New'>HN</font></TD>
	<TD><font face='Angsana New'>ชื่อ</font></TD>
	<TD><font face='Angsana New'>ID</font></TD>
	<TD><font face='Angsana New'>สิทธิ์</font></TD>
</TR>

<?php
$i=1;
while(list($hn,$name,$id,$ptright) = Mysql_fetch_row($result)){

echo "<TR BGCOLOR=66CDAA>
				<TD><font face='Angsana New'>",$i,"</font></TD>
				<TD><font face='Angsana New'>",$hn,"</font></TD>
				<TD><font face='Angsana New'>",$name,"</font></TD>
				<TD><font face='Angsana New'>",$id,"</font></TD>
				<TD><font face='Angsana New'>",$ptright,"</font></TD>
			</TR>";
$i++;

}


include("unconnect.inc");


?>
</TABLE>