<?php
session_start();
include("connect.inc");  

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
<SCRIPT LANGUAGE="JavaScript">
	function check_number() {
	e_k=event.keyCode
	if (e_k != 13 && e_k != 45 && (e_k < 48) || (e_k > 57)) {
	event.returnValue = false;
	alert("กรุณากรอกเป็นตัวเลขเท่านั้น");
	return false;
	}
	}
</SCRIPT>
</HEAD>
<BODY>


<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		if(document.f1.bring_no.value ==""){
			alert("กรุณากรอกเลขที่ใบเบิก");
			return false;
		}else{
			return true;
		}
	}

</SCRIPT>

<FORM METHOD=POST ACTION="" name="f1" Onsubmit="return checkForm();">
<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>

<?php


echo "<TABLE width='800' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
<TR align='center' bgcolor='#3366FF' class='font_title'>
	<TD>No.</TD>
	<TD>DRUGCODE</TD>
	<TD>ชื่อยา</TD>
	<TD>ขอเบิก</TD>
</TR>";

$sql = "Select a.drugcode, a.bring_amount, b.tradname From bring_detail as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where bring_id = '".$_GET["id"]."' ";

$result = Mysql_Query($sql);

while($arr = Mysql_fetch_assoc($result)){
echo "<TR>
	<TD align='center'>",++$j,"</TD>
	<TD>&nbsp;",$arr[drugcode],"</TD>
	<TD>&nbsp;",$arr[tradname],"</TD>
	<TD align='center'>",$arr["bring_amount"],"
	</TD>
</TR>";

}

echo "</TABLE>";
?></TD>
</TR>
</TABLE>
</FORM>
</BODY>
</HTML>
<?php
include("unconnect.inc");
?>
