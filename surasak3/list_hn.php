<?php
//Update 31 พค. 53 bbm
session_start();

if(isset($_GET["action"]) && $_GET["action"] != ""){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] != ""){
	
	$sql = "Select CONCAT( `yot` , ' ', `name` , ' ', `surname` ) AS `full_name` From opcard where hn = '".$_GET["action"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);
	
	echo $fullname;
exit();
}

?>
<html>
<head>
<title>พิมพ์รายชื่อผู้ป่วยนัด</title>
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
	
	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function checkname(hn) {
	
	var hn_value = "";

			url = 'appoint2.php?action='+hn;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			hn_value = xmlhttp.responseText;
	
	return hn_value;

}

	function add_hn(){
		var hn_true = "";

		hn_true = checkname(document.getElementById('HN').value);
		if(hn_true.length <= 4){
			alert("ไม่มีหมายเลข HN "+document.getElementById('HN').value);
		}else if(hn_true.length > 4){
			document.getElementById('list_hn').innerHTML =  "<INPUT TYPE=\"checkbox\" name=\"list_hn[]\" value=\""+document.getElementById('HN').value+"\" checked>&nbsp;"+document.getElementById('HN').value + " "+hn_true+"<BR>"+document.getElementById('list_hn').innerHTML;
			document.getElementById("hn").select();
		}

	}

</SCRIPT>

</head>
<body>

&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; เมนู</a>
<TABLE width="100%" align="center" border="0">
<TR valign="top">
	<TD align="center" width="276">
	
	<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>

<TABLE>
<TR>
	<TD align="right">
	HN :	</TD>
	<TD>
	<INPUT TYPE="text" ID="HN" NAME="HN" onkeypress = "if(event.keyCode == 13){ add_hn(); }">	</TD>
</TR>
<TR>
	<TD colspan="2" align="center">
		<INPUT TYPE="button" value="ตกลง" Onclick="add_hn();">	&nbsp; <input name="Button" type="button" value="พิมพ์" onClick="checkForm();"></TD>
</TR>
</TABLE></TD>
</TR>
</TABLE>
    <TD align="left" width="683">
	<FORM Name="f1" METHOD=POST ACTION="print_list_hn.php" Onsubmit="return checkForm();">
<DIV ID="list_hn"></Div>

</FORM>    
   
</TD>
</TR>
</TABLE>


	</TD>
	<TD align="center">


<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		
		var stat = true;
		
		if(document.getElementById('list_hn').innerHTML == ""){
			alert("กรุณากรอก HN ");
			
		}else{
			f1.submit();
		}

	}

</SCRIPT>


	</TD>
</TR>
</TABLE>


</body>
</html>
<?php include("unconnect.inc");?>
