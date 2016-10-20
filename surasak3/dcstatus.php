<?php
//Update 31 พค. 53 bbm
session_start();

/** Ajax Response Start **/
if(isset($_GET["action"]) && $_GET["action"] != ""){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include 'connect.inc';


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

if(isset($_POST["actiondc"]) && $_POST["actiondc"] != ""){

	$an = trim($_POST["actiondc"]);

	// AN นี้ยังไม่ได้จำหน่าย แสดงว่า dcdate ยังเป็น 0000-00-00 00:00:00
	$sql = "SELECT `date`,`an`,`hn`,`dcdate`,`dcnumber`,`ptname`,`my_ward` 
	FROM `ipcard` 
	WHERE `an` = '$an' 
	LIMIT 1 ";
	$result = mysql_query($sql) or die( mysql_error() );
	$item = mysql_fetch_assoc($result);

	if( $item === false ){
		
		$txt = '{"state":400,"msg":"ไม่พบข้อมูลผู้ป่วย AN: '.$an.'"}';

	}else if( $item['dcdate'] === '0000-00-00 00:00:00' ){

		$ward = '';
		if( !empty($item['my_ward']) ){
			$ward = '('.$item['my_ward'].')';
		}
		
		$message = 'หมายเลข AN '.$item['an'].' นี้ยังไม่ได้จำหน่าย กรุณาจำหน่ายก่อน'.$ward;
		$txt = '{"state":400,"msg":"'.$message.'","dcnumber":200}';

	}else if( empty($item['dcnumber']) ){

		$message = 'หมายเลข AN '.$item['an'].' นี้ยังไม่ได้ให้เลขการจำหน่าย';
		$txt = '{"state":400,"msg":"'.$message.'","dcnumber":400}';
	
	}else{

		// ทุกอย่างโอเครรรรร ดีใจมั้ย... เอ้าาาา ดีจาาาาย
		$txt = '{"state":200,"an":"'.$item['an'].'","ptname":"'.$item['ptname'].'","dcnumber":"'.$item['dcnumber'].'"}';

	}
	
    header('Content-Type:text/html; charset=tis-620');
    echo $txt;
	exit;
}
/** Ajax Response End **/

?>
<html>
<head>
<title>บันทึกสถานะประวัติผู้ป่วยใน</title>
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
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>
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

if(typeof String.prototype.trim !== 'function'){
	String.prototype.trim = function(){
		return this.replace(/^\s+|\s+$/g, '');
	}
}

function add_an(){

	var an = document.getElementById('AN').value;
	var newSm = new SmHttp();
	newSm.ajax(
		'dcstatus.php', 
		{ 'actiondc': an }, 
		function(res){
			var txt = JSON.parse(res);
			if( txt.state === 400 ){

				alert(txt.msg);

				if( txt.dcnumber === 400 ){
					window.open("ipdcno_auto.php?an="+an, "_blank");
				}

			}else{

				var html_list = document.getElementById('list_an').innerHTML
								+'<input type="checkbox" name="list_an[]" value="'+an+'" checked="checked"> '
								+an+' '+txt.ptname+' DC No:'+txt.dcnumber+'<br>';

				document.getElementById('list_an').innerHTML = html_list;
				document.getElementById("AN").select();
			}
		}
	);
	
	return false;
}
</SCRIPT>
</head>
<body>
&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; เมนู</a>
&nbsp;&nbsp;<a target=_top  href="../surasak3/anchkstatus.php">&lt;&lt; ตรวจสอบสถานะ</a>

<TABLE width="100%" align="center">
	<TR valign="top">
		<TD align="center">
			<TABLE  border="1" bordercolor="#3366FF">
				<TR>
					<TD>
						<form action="dcstatus.php" method="post" onsubmit="return add_an()">
							<TABLE>
								<TR>
									<TD align="right">AN : </TD>
									<TD>
										<INPUT type="text" id="AN" name="AN">
									</TD>
								</TR>
								<TR>
									<TD colspan="2" align="center">
										<button type="button" onclick="return add_an()">ตกลง</button>
									</TD>
								</TR>
							</TABLE>
						</form>
					</TD>
				</TR>
			</TABLE>
		</TD>
		<TD align="center">

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		
		var stat = true;
		
		if(document.getElementById('list_an').innerHTML == ""){
			alert("กรุณากรอก AN ");
			stat = false;
		}else if(document.f1.status.value == ""){
			alert("กรุณาระบุสถานะ");
			stat = false;
		}

	return stat;

	}
	
	function statuschange(){
		if(document.getElementById('status').value=="ยืมเพื่อทบทวน"){
			document.getElementById('status2').style.display="block";
		}else{
			document.getElementById('status2').style.display="none";
		}
	}

</SCRIPT>

<?php

$back = isset($_REQUEST['back']) ? $_REQUEST['back'] : false ;
$an = isset($_REQUEST['an']) ? ( is_array($an) ? $an : array($an) ) : false ;

// สร้าง input เพื่อแสดง checkbox
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
						<TD colspan="2" align="center" class="font_title">ระบบบันทึกสถานะประวัติผู้ป่วยใน</TD>
					</TR>
					<TR valign="top">
						<TD align="right">AN : </TD>
						<TD colspan="2">
							<DIV ID="list_an"><?php echo $an_txt;?></Div>
						</TD>
					</TR>
					<TR>
						<TD align="right">สถานะ</TD>
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
								<option value='ยืม'>ยืม</option>
								<option value='ยืมเพื่อทบทวน'>ยืมเพื่อทบทวน</option>
							</select>
   						</TD>
 						<TD>
							<INPUT TYPE="text" NAME="status1" id="status1">
							<select name="status2"  id="status2" style="display:none">
								<option>ทบทวน Case วิจัย/ค้นคว้า</option>
								<option>ทบทวน Dead</option>
								<option>ทบทวน Refer</option>
								<option>ทบทวนกรณีฟ้องร้อง/คดี</option>
							</select>
						</TD>
					</TR>
					<TR>
						<TD colspan="3" align="center">
							<INPUT TYPE="submit" value="  ตกลง  ">
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
