<?
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");
function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

if(isset($_GET["action"]) && $_GET["action"] == "searchicd10"){
	
	$sql = "Select code, detail,diag_thai,diag_eng From icd10 where code like '%".$_GET["search1"]."%' ";
	$result = mysql_query($sql);

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
				<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FCC6C2";
				else
					$bgcolor="#C5E8FC";
					
		
			echo "<tr bgcolor=\"$bgcolor\" >
					<td>",$arr["code"],"</td>
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('eng').value = '",jschars($arr["diag_eng"]),"';document.getElementById('thai').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML ='';\">",$arr["detail"],"</A></td>
					<td></td>
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
//////////////////////////////////////////


if(isset($_GET["action"]) && $_GET["action"] == "diag"){
	
	$sql = "Select code, detail,diag_thai,diag_eng From icd10 where detail LIKE '%".$_GET["search1"]."%' limit 10";
	$result = mysql_query($sql);
	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
				<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";


		$i=1;

		while($se = Mysql_fetch_assoc($result)){
			
				if($i%2==0)
					$bgcolor="#FCC6C2";
				else
					$bgcolor="#C5E8FC";
					
		echo "<tr bgcolor=\"$bgcolor\"><td valign=\"top\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",jschars($se["detail"]),"';document.getElementById('".$_GET["getto2"]."').value = '",$se["code"],"';document.getElementById('eng').value = '",jschars($se["diag_eng"]),"';document.getElementById('thai').value = '",jschars($se["diag_thai"]),"';document.getElementById('list').innerHTML ='';\">&nbsp;",$se["detail"],"</A></td><td valign=\"top\">",$se["code"],"</td><td valign=\"top\" colspan=\"2\" >&nbsp;</td></tr>";
		$i++;
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>

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

function searchSuggest1(str,len,getto,getto2) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'nkdiag.php?action=diag&search1=' + str+'&getto=' + getto+'&getto2=' + getto2;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
function searchSuggest2(str,len,getto,getto2) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'nkdiag.php?action=searchicd10&search1=' + str+'&getto=' + getto+'&getto2=' + getto2;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</SCRIPT>
<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<fieldset>
<form id="form1" name="form1" method="post" action="nkdiag_ok.php">
  <table width="89%" border="0">
    <tr>
      <td colspan="4" align="center">โปรแกรมบันทึกชื่อย่อ Diag</td>
    </tr>
    <tr>
      <td height="22" colspan="4" align="center">เลือกการค้นหา</td>
      </tr>
    <tr>
      <td width="9%" height="57" align="right">ICD10 :</td>
      <td width="24%"><input name="icd10" type="text" id="icd10" onKeyPress="searchSuggest2(this.value,2,'icd10','detail');" size="10"/><Div id="list" style="left:200PX;top:150PX;position:absolute;"></Div></td>
      <td width="20%">Detail : </td>
      <td width="47%"><input name="detail" type="text" id="detail" onKeyPress="searchSuggest1(this.value,2,'detail','icd10');" size="50"/></td>
    </tr>
    <tr>
      <td height="4" colspan="4" align="right"><hr></td>
    </tr>
    <tr>
      <td height="57" align="right">ชื่อย่อ :</td>
      <td height="57"><input type="text" name="eng" id="eng" /></td>
      <td height="57">ชื่อเต็มภาษาไทย : </td>
      <td height="57"><input type="text" name="thai" id="thai" /></td>
    </tr>
    <tr>
      <td height="53" colspan="4" align="center">
        <input type="submit" name="okbtn" id="okbtn" value=" ตกลง " /></td>
    </tr>
  </table>
</form>
</fieldset>
</body>
</html>