<?php
session_start();
include("connect.inc");

if(isset($_POST["submit"])){
	
	if($_POST["type"] == "hn"){
		$where = " Where hn = '".$_POST["hn_value"]."' ";
	}else if($_POST["type"] == "name"){
		$where = " Where name = '".$_POST["firstname"]."' AND surname = '".$_POST["lastname"]."' " ;
	}else{
		$where = " Where idcard = '".$_POST["id_value"]."' ";
	}

	$sql = "Select hn From opcard  ".$where;
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) == 0){
		
		echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
			
				alert('ไม่มีข้อมูลผู้ป่วยที่ท่านระบุ');
			
			</SCRIPT>
		";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."\">";
	}else if($_POST["type"] == "name" && Mysql_num_rows($result) > 1){
		
				echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
			
				alert('ขออภัยข้อมูลที่ท่านระบุมีข้อมูลผู้ป่วยมากกว่า 1 คน');
			
			</SCRIPT>
		";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=".$_SERVER['PHP_SELF']."\">";
		
	}else{
		$arr = Mysql_fetch_assoc($result);
		$_SESSION["cHn"] = $arr["hn"];
		echo "<SCRIPT LANGUAGE=\"JavaScript\">
						window.open('opdprint1bc.php','print1bc');
					</SCRIPT>	";
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=".$_SERVER['PHP_SELF']."\">";
		exit();
	}


}

?>

<SCRIPT LANGUAGE="JavaScript">

			window.onload =function(){ document.f1.hn_value.focus(); readonlyall(document.f1.hn_value,''); }

			function readonlyall(xxx,yyy){

				document.f1.hn_value.value = "";
				document.f1.firstname.value = "";
				document.f1.lastname.value = "";
				document.f1.id_value.value = "";
				xxx.readOnly = false;
				if(yyy != ''){
					yyy.readOnly = false;
				}
			}

function Numberonly(e)
{
var keynum;
var keychar;
var numcheck;

if(window.event) // IE
  {
  keynum = e.keyCode;
  }
else if(e.which) // Netscape/Firefox/Opera
  {
  keynum = e.which;
  }

	if(keynum >= 48 && keynum <= 57){
		numcheck = true;
	}else{
		numcheck = false;
	}
return numcheck;
}

function Hnonly(e)
{
var keynum;
var keychar;
var numcheck;

if(window.event) // IE
  {
  keynum = e.keyCode;
  }
else if(e.which) // Netscape/Firefox/Opera
  {
  keynum = e.which;
  }

	if(keynum == 45 || (keynum >= 48 && keynum <= 57)){
		numcheck = true;
	}else{
		numcheck = false;
	}
return numcheck;
}

function checkForm(){
var stat = true;
if(document.f1.type[0].checked == true){

	if(document.f1.hn_value.value == ''){
		alert("กรุณากรอก HN ");
		document.f1.hn_value.focus();
		stat = false;
	}

}else if(document.f1.type[1].checked == true){
	
	if(document.f1.firstname.value == '' && document.f1.lastname.value == ''){
		alert("กรุณากรอก ชื่อ - สกุล ");
		stat = false;
		document.f1.firstname.focus();
	}else	if(document.f1.firstname.value == ''){
		alert("กรุณากรอก ชื่อ ");
		stat = false;
		document.f1.firstname.focus();
	}else if(document.f1.lastname.value == ''){
		alert("กรุณากรอก สกุล ");
		stat = false;
		document.f1.lastname.focus();
	}

}else if(document.f1.type[2].checked == true){

	if(document.f1.id_value.value == ''){
		alert("กรุณากรอก ID ");
		stat = false;
		document.f1.id_value.focus();
	}

}

return stat;
}

</SCRIPT>
<BR><BR>
<A HREF="../nindex.htm">&lt;&lt;ไปเมน</A>ู
<FORM Name="f1" METHOD=POST ACTION="" Onsubmit = "return checkForm();">
	<Table border="0" align="center">
	<TR>
		<TD width="1">
	<input type="radio" name="type" value="hn" checked onclick="readonlyall(document.f1.hn_value,''); document.f1.hn_value.focus();">
	</TD><TD align="right">HN&nbsp;:&nbsp;</TD><TD>
	<input type="textbox" name="hn_value" onkeypress="return Hnonly(event)" onclick="readonlyall(document.f1.hn_value,''); document.f1.hn_value.focus(); document.f1.type[0].checked = true;"> 
		</TD>

	</TR>
<TR>
	<TD>
	<input type="radio" name="type" value="name" onclick="readonlyall(document.f1.firstname,document.f1.lastname); document.f1.firstname.focus();">
	</TD><TD align="right">ชื่อ&nbsp;:&nbsp;</TD><TD>
	<input type="textbox" name="firstname" onclick="readonlyall(document.f1.firstname,document.f1.lastname); document.f1.firstname.focus();document.f1.type[1].checked = true;">
	&nbsp;&nbsp;
	สกุล&nbsp;:&nbsp;
	<input type="textbox" name="lastname" onclick="readonlyall(document.f1.firstname,document.f1.lastname); document.f1.type[1].checked = true;" >
	</TD>
</TR>
<TR><TD>
	<input type="radio" name="type" value="id" onclick="readonlyall(document.f1.id_value,'');  document.f1.id_value.focus();"></TD><TD align="right">ID&nbsp;:&nbsp;</TD><TD>
	<input type="textbox" name="id_value" maxlength="13" onkeypress="return Numberonly(event)" onclick="readonlyall(document.f1.id_value,'');  document.f1.id_value.focus(); document.f1.type[2].checked = true;">
	</TD></TR>
	<TR><TD align="center"  colspan="3">
	<INPUT TYPE="submit" name="submit" value="ตกลง">&nbsp;&nbsp;<INPUT TYPE="reset" value="ยกเลิก">
	</TD></TR>
</Table>
</FORM>
<?php
include("unconnect.inc");
?>