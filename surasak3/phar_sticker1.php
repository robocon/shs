<?php
include("connect.inc");

	$sql ="Select a.prepack_id,  a.drugcode,  a.total,  a.lot , a.startdate , a.enddate, b.tradname   From stiker_prepack as a , druglst  as b where prepack_id = '".$_GET["id"]."' AND a.drugcode  = b.drugcode  ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);

include("unconnect.inc");

?>
<html>
<head>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<SCRIPT LANGUAGE="JavaScript"> 
window.onload = function(){
	if(!print()){
	
	}
}
</SCRIPT>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0"  width="262" height="110">
  <tr>
    <td colspan="3" height="1"></td>
  </tr>
  <tr>
    <td width="10"></td>
    <td valign="top">
<?php
		print "<font face='Angsana New' size='2'>ยา<b>".$arr["tradname"]."</b><br></font>";
		print "<font face='Angsana New' size='2'>Lot. No.&nbsp;:&nbsp;".$arr["lot"]."&nbsp;&nbsp;</font>";
		print "<font face='Angsana New' size='2'>จำนวน&nbsp;:&nbsp;".$arr["total"]."<BR></font>";
		print "<font face='Angsana New' size='2'>วันผลิต&nbsp;:&nbsp;".$arr["startdate"]."<br></font>";
		print "<font face='Angsana New' size='3'><b>หมดอายุ&nbsp;:&nbsp;".$arr["enddate"]."</b></font>";
?></td>
    <td width="56"></td>
  </tr>
</table>
</body>
</html>

