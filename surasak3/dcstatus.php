<?php
//Update 31 ��. 53 bbm
session_start();

/** Ajax Response Start **/
if(isset($_GET["action"]) && $_GET["action"] != ""){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] != ""){
	
	$sql = "Select ptname From ipcard where an = '".$_GET["action"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);
	
	echo $fullname;
exit();
}

if(isset($_GET["actiondcno"]) && $_GET["actiondcno"] != ""){
	
	$sql = "Select dcnumber From ipcard where an = '".$_GET["actiondcno"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);
	
	echo $fullname;
exit();
}

if(isset($_GET["actiondc"]) && $_GET["actiondc"] != ""){
	
	$sql = "Select days From ipcard where an = '".$_GET["actiondc"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);
	if($fullname=="null") $fullname=0;
	
	echo $fullname;
exit();
}
/** Ajax Response End **/

?>
<html>
<head>
<title>�ѹ�֡ʶҹл���ѵԼ������</title>
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

function checkname(an) {
	if(an === ''){
		return false;
	}
	var an_value = "";

			url = 'dcstatus.php?action='+an;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			an_value = xmlhttp.responseText;
	
	return an_value;

}
function checkdc(an) {
	if(an === ''){
		return false;
	}
	var an_value = "";

			url = 'dcstatus.php?actiondc='+an;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			an_value = xmlhttp.responseText;
	
	return an_value;

}

function checkdcno(an) {
	if(an === ''){
		return false;
	}
	var an_value = "";

			url = 'dcstatus.php?actiondcno='+an;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			an_value = xmlhttp.responseText;
	
	return an_value;

}

	function add_an(){
		var an_true = "";
		var an_dc = "";
		an_true = checkname(document.getElementById('AN').value);
		an_dc = checkdcno(document.getElementById('AN').value);
		an_dc2 = checkdc(document.getElementById('AN').value);
		//alert(an_dc2.length);
		//alert(an_dc2);
		if(an_true.length <= 4){
			alert("����������Ţ AN "+document.getElementById('AN').value);
		}else if(an_dc2.length<=4){
			alert("�����Ţ AN ����ѧ������˹��� ��سҨ�˹��¡�͹ ");
		}else if(an_dc.length <= 4){
			//alert(an_dc2.length);
			window.open("ipdcno_auto.php?an="+document.getElementById('AN').value);
			//alert("AN ����ѧ���������Ţ��è�˹��¼����� ��س�����Ţ��è�˹��¼����¡�͹");
		}else if(an_true.length > 4){
			document.getElementById('list_an').innerHTML = document.getElementById('list_an').innerHTML + "<INPUT TYPE=\"checkbox\" name=\"list_an[]\" value=\""+document.getElementById('AN').value+"\" checked>&nbsp;"+document.getElementById('AN').value + " "+an_true+" DC No:"+an_dc+"<BR>";
			document.getElementById("AN").select();
		}

	}

</SCRIPT>

</head>
<body>

&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; ����</a>
&nbsp;&nbsp;<a target=_top  href="../surasak3/anchkstatus.php">&lt;&lt; ��Ǩ�ͺʶҹ�</a>
<TABLE width="100%" align="center">
	<TR valign="top">
		<TD align="center">
			<TABLE  border="1" bordercolor="#3366FF">
				<TR>
					<TD>
						<TABLE>
							<TR>
								<TD align="right">AN : </TD>
								<TD>
									<INPUT TYPE="text" ID="AN" NAME="AN" onkeypress = "if(event.keyCode == 13){ add_an(); }" value="">
								</TD>
							</TR>
							<TR>
								<TD colspan="2" align="center">
									<INPUT TYPE="button" value="��ŧ" Onclick="add_an();">
								</TD>
							</TR>
						</TABLE>
					</TD>
				</TR>
			</TABLE>
		</TD>
		<TD align="center">

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		
		var stat = true;
		
		if(document.getElementById('list_an').innerHTML == ""){
			alert("��سҡ�͡ AN ");
			stat = false;
		}else if(document.f1.status.value == ""){
			alert("��س��к�ʶҹ�");
			stat = false;
		}

	return stat;

	}
	
	function statuschange(){
		if(document.getElementById('status').value=="������ͷ��ǹ"){
			document.getElementById('status2').style.display="block";
		}else{
			document.getElementById('status2').style.display="none";
		}
	}

</SCRIPT>
<?php
$back = isset($_REQUEST['back']) ? $_REQUEST['back'] : false ;
$an = isset($_REQUEST['an']) ? ( is_array($an) ? $an : array($an) ) : false ;

// ���ҧ input �����ʴ� checkbox
$an_txt = '';
if( $an !== false ){
	
	
	foreach($an as $key => $item_an){
		$sql = "SELECT `an`,`ptname`,`dcnumber` FROM `ipcard` WHERE `an` = '$item_an' LIMIT 1 ";
		$q = mysql_query($sql);
		$item = mysql_fetch_assoc($q);
		
		$an_txt .= '<input name="list_an[]" value="'.$item['an'].'" checked="" type="checkbox">
		'.$item['an'].' '.$item['ptname'].' DC No: '.$item['dcnumber'].'<br>';
	}
}

?>
<FORM Name="f1" METHOD=POST ACTION="dcstatus2.php" Onsubmit="return checkForm();">
	<TABLE  border="1" bordercolor="#3366FF">
		<TR>
			<TD>
				<TABLE>
					<TR bgcolor="#3366FF">
						<TD colspan="2" align="center" class="font_title">�к��ѹ�֡ʶҹл���ѵԼ������</TD>
					</TR>
					<TR valign="top">
						<TD align="right">AN : </TD>
						<TD colspan="2">
							<DIV ID="list_an"><?php echo $an_txt;?></Div>
						</TD>
					</TR>
					<TR>
						<TD align="right">ʶҹ�</TD>
						<TD>
							<? 
							$strSQL = "SELECT name FROM departments where statusdc='y' order by name"; 
							$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
							?>
							<select name="status" id="status" onChange="statuschange()"> 
								<? 
								while($objResult = mysql_fetch_array($objQuery)) { 
									?> 
									<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option>  
									<? 
								} 
								?> 
								<option value='���'>���</option>
								<option value='������ͷ��ǹ'>������ͷ��ǹ</option>
							</select>
   						</TD>
 						<TD>
							<INPUT TYPE="text" NAME="status1" id="status1">
							<select name="status2"  id="status2" style="display:none">
								<option>���ǹ Case �Ԩ��/�鹤���</option>
								<option>���ǹ Dead</option>
								<option>���ǹ Refer</option>
								<option>���ǹ�óտ�ͧ��ͧ/���</option>
							</select>
						</TD>
					</TR>
					<TR>
						<TD colspan="3" align="center">
							<INPUT TYPE="submit" value="  ��ŧ  ">
							<input type="hidden" name="back" value="<?php echo $back;?>">
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</FORM>
		</TD>
	</TR>
</TABLE>
</body>
</html>
<?php include("unconnect.inc");?>
