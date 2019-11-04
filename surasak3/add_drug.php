<?php
    session_start();

if(isset($_GET["action"]) && ($_GET["action"] == "drug_interaction" || $_GET["action"] == "drug_alert")){
	header("content-type: application/x-javascript; charset=TIS-620");
}
	 include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] == "drug_interaction"){
	
	$list = "";
	
	for($j=0;$j<$_SESSION["num_list"];$j++){
		$list .= "'".trim($_SESSION["list_druglst"]["drugcode"][$j])."',";
	}
		$list = substr($list,0,-1);
	if($_SESSION["num_list"] == 0){

		echo "0";
		exit();
	}

	$sql = "SELECT first_drugcode, between_drugcode, effect, action, follow, onset, violence, referable  FROM drug_interaction  where (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list.") ) ";
	
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
		if($rows == 0){
			echo "0";
		}else{
			$arr = Mysql_fetch_assoc($result);
			$i=0;
			$sql = " Select genname From  druglst where drugcode in ('".$arr["first_drugcode"]."','".$arr["between_drugcode"]."') ";
			$result = Mysql_Query($sql);
			while($arr2 = Mysql_fetch_assoc($result)){
				$druglist[$i] = $arr2["genname"];
				$i++;
			}

			echo " เกิด Drug Interaction ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n ผลกระทบ : ".$arr["effect"]." \n กลไกที่เกิด : ".$arr["action"]." \n การติดตาม : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n ความรุนแรง : ".$arr["violence"]." \n หลักฐาน : ".$arr["referable"]." \n ท่านยังต้องการจ่ายยาหรือไม่? ";
		}
	
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "drug_alert"){
	
	$sql = "SELECT row_id, tradname FROM drugreact  where drugcode = '".$_GET["drugcode"]."' AND hn = '".$_SESSION["hn_now"]."' limit 1 ";

	
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
		if($rows == 0){
			echo "0";
		}else{
			$arr = Mysql_fetch_assoc($result);

			echo "คนไข้แพ้ยา ".$arr["tradname"]." , (".$_GET["drugcode"].")  \n ท่านยังต้องการจ่ายยาหรือไม่? ";
		}

	exit();
}

	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

// ************************************************************ Submit ************************************************************
if(isset($_POST["Save_dgprofile"]) && $_POST["Save_dgprofile"] == "บันทึกข้อมูลใน DrugProfile" ){
	
	for($j=0;$j<$_SESSION["num_list"];$j++){
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$w["drugcode"][$i] = $_SESSION["list_druglst"]["drugcode"][$j];
			$w["tradname"][$i] = $_SESSION["list_druglst"]["tradname"][$j];
			$w["part"][$i] = $_SESSION["list_druglst"]["part"][$j];
			$w["slcode"][$i] = $_SESSION["list_druglst"]["slcode"][$j];
			$w["statcon"][$i] = $_SESSION["list_druglst"]["statcon"][$j];
			$w["amount"][$i] = $_SESSION["list_druglst"]["amount"][$j];
			$w["row_id"][$i] = $_SESSION["list_druglst"]["row_id"][$j];
			$i++;

		}
	}

$Thidate = (date("Y")+543).date("-m-d H:i:s");


 /*
 $query = "
	INSERT INTO dphardep
	(chktranx,date,ptname,hn,an,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright,whokey)
	VALUES
	('".$nRunno."','".$date."','".$ptname."','".$hn."','".$an."','".$price."','".$doctor."','".$item."','".$idname."','".$diag."','".$essd."','".$nessdy."','".$nessdn."','".$dpy."','".$dpn."','".$dsy."','".$dsn."','".$accno."','".$tvn."','".$ptright."','".$whokey."');
	";
*/
	
	$sql2 = "INSERT INTO dgprofile(date,an,drugcode,tradname,unit,salepri,freepri,amount,price,slcode,part,statcon,onoff,dateoff,officer )VALUES ";
	
	$add_status = false;

	for($j=0;$j<$_SESSION["num_list"];$j++){
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$add_status = true;
			$sql = "Select salepri, freepri, part, unit, tradname   From druglst where drugcode = '".$_SESSION["list_druglst"]["drugcode"][$j]."' limit 0,1 ";
			list($salepri, $freepri, $part, $unit, $tradname) = Mysql_fetch_row(Mysql_Query($sql));

		 $sql2 .= "
			('".$Thidate."','".$_GET["an"]."','".$_SESSION["list_druglst"]["drugcode"][$j]."','".$tradname."','".$unit."','".$salepri."','".$freepri."', '".$_SESSION["list_druglst"]["amount"][$j]."','".($salepri * $_SESSION["list_druglst"]["amount"][$j])."','".$_SESSION["list_druglst"]["slcode"][$j]."','".$part."','".$_SESSION["list_druglst"]["statcon"][$j]."','ON','','".$_SESSION["sOfficer"]."'), ";  
			
			$i++;
		}
	}
		
		$sql2 = substr($sql2,0,-2);

		if($add_status == true)
			$result = Mysql_Query($sql2);
		else
			$result = false;


		if($result == true || $_SESSION["num_list"] > 0){
			$txt = "<BR><BR><CENTER>ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว<BR>
				<A HREF=\"phardividedrug.php?an=".$_GET["an"]."&bed=".$_GET["bed"]."&bedcode=".$_GET["bedcode"]."\">ตัดจ่ายยา</A>&nbsp;&nbsp;<A HREF=\"enddrugprofile.php\">กลับหน้าward</A>
			</CENTER>";
		}else{
			$txt = "<BR><BR><CENTER>เกิดความผิดพลาดในการเพิ่มข้อมูล</CENTER>";
		}
	
	echo $txt;
	//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"6;URL=",$_SERVER["php_self"],"\">";

exit();

}
// ***************************************************** จบ Submit **************************************************


// ***************************************************** กำหนด Session **************************************************
	session_unregister($list_druglst);
	session_unregister($num_list);

	session_register($list_druglst);
	session_register($num_list);

		$_SESSION["num_list"] = 0;

		$sql = "Select drugcode, tradname, amount, slcode, statcon, row_id,part From dgprofile where an = '".$_GET["an"]."' AND left( drugcode, 1 ) in ('0','1','2','3','4','5','6','7','8','9') AND ((onoff = 'ON' AND (statcon = 'CONT' OR statcon = 'OLD')) OR (`date` like '".(date("Y")+543).date("-m-d")."%' AND (statcon = 'STAT' OR statcon = 'STAT1') ) ) Order by row_id ASC ";


		$result = Mysql_Query($sql);
		while($arr = Mysql_fetch_assoc($result)){
			
			$_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]] = $arr["drugcode"];
			$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $arr["tradname"];
			$_SESSION["list_druglst"]["part"][$_SESSION["num_list"]] = $arr["part"];
			$_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]] = $arr["slcode"];
			$_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]] = $arr["statcon"];
			$_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]] = $arr["amount"];
			$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = $arr["row_id"];


			$_SESSION["num_list"]++;
		}
// ***************************************************** จบ กำหนด Session **************************************************
?>
<html>
<head>
<title>เพิ่ม/ลบ/แก้ไข Drugprofile</title>
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

#slidemenubar, #slidemenubar2{
position:absolute;
left:-155px;
width:160px;
top:250px;
border:1.5px solid #FFCC00;


layer-background-color:lightyellow;
font:bold 12px ms sans serif;
line-height:20px;

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

function searchSuggest(action,str) {
	
		if(!submit_button(action)){
			return false;
		}

		if(action == 'drugcode')
			lengthsearch = 3;
		else
			lengthsearch = 2;


		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= lengthsearch){
			url = 'listAjax.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("listdrugcode").innerHTML = xmlhttp.responseText;
		}
}


function submit_button(action){
	
	if(event.keyCode == 13){
			if(action == "drugcode")
				document.getElementById('drugslip').focus();
			else if(action == "drugslip")
				document.getElementById('amount').focus();
			else if(action == "amount")
				document.getElementById('statcon').focus();
			else if(action == "statcon")
				document.getElementById('button_submit').focus();

		return false;
	}else{
		return true;
	}

}

function checkData(){

var stat = true;
var txt = "";

	if(document.getElementById('drugcode').value == ""){
		txt = txt+"กรุณากรอก รหัสยา  ด้วยครับ \n";
		stat = false;
	}

	if(document.getElementById('drugslip').value == ""){
		txt = txt+"กรุณากรอก วิธีใช้  ด้วยครับ \n";
		stat = false;
	}

	if(document.getElementById('amount').value == ""){
		txt = txt+"กรุณากรอก จำนวน  ด้วยครับ \n";
		stat = false;
	}

	if(document.getElementById('statcon').value == ""){
		txt = txt+"กรุณาเลือก สถานะ  ด้วยครับ \n";
		stat = false;
	}
	

	if(stat == false){
		alert(txt);
	}
return stat;
}

function clearData(){
	
	document.getElementById('drugcode').value = "";
	document.getElementById('drugname').value = "";
	document.getElementById('drugslip').value = "";
	document.getElementById('amount').value = "";
	document.getElementById('unit').value = "";
	document.getElementById('unit2').value = "";
	document.getElementById('statcon').options[0].selected = true;

}



function add_session(){

	if(checkData() == true){
		
		var drugcode;
		var slcode;
		var amount;
		var statcon;
		var tradname;
		var part;
		an = '<?php echo $_GET["an"];?>';
		drugcode = document.getElementById('drugcode').value;
		drugcode = encodeURI(drugcode);
		slcode = document.getElementById('drugslip').value;
		slcode = encodeURI(slcode);
		tradname = document.getElementById('drugname').value;
		part = document.getElementById('unit2').value;
		amount = document.getElementById('amount').value;
		statcon = document.getElementById('statcon').value;
	
		if(drug_alert(document.getElementById('drugcode').value)){ //ตรวจสอบการแพ้ยา
		if(drug_interaction(document.getElementById('drugcode').value)){ //ตรวจสอบ drug interaction

		action = "add";
		url = 'listAjax.php?action='+action+'&drugcode='+drugcode+'&tradname='+tradname+'&slcode='+slcode+'&amount='+amount+'&statcon='+statcon+'&part='+part+'&an='+an;

		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
		clearData();
		document.getElementById('drugcode').focus();
		list_off();
		}
		}

	}
}

function del_session(delnum,rowid){

	if(rowid != ""){
		txt = "คุณต้องการ OFF ยา ใช่หรือไม่";
		rowid = "&rowid="+rowid;
	}else{
		txt = "คุณต้องการ ลบ ยาออกจากรายการใช่หรือไม่";
	}
	if(confirm(txt)){
		action = "del";
		an = '<?php echo $_GET["an"];?>';

		url = 'listAjax.php?action='+action+'&delnum='+delnum+'&an='+an+rowid;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
				list_off();
	}
}

function edit_list(delnum,rowid,slcode,amount,statusdrug){

txt = "คุณต้องการ แก้ไขข้อมูล ใช่หรือไม่";

get_slcode = "&slcode="+slcode;
get_amount = "&amount="+amount;
get_stat = "&statcon="+statusdrug;
	if(slcode == 'OLD'){
		amount = 0;
	}

	if(rowid != ""){
		rowid = "&rowid="+rowid;
	}else{
		rowid = "";
	}
	if(slcode == "" || amount == ""){
		alert("กรุณา กรอกข้อมูล วิธีใช้ และ จำนวนยาให้ครบด้วยครับ");
	}else	if(confirm(txt)){
		action = "edit";
		an = '<?php echo $_GET["an"];?>';

		url = 'listAjax.php?action='+action+'&delnum='+delnum+'&an='+an+get_slcode+get_amount+rowid+get_stat;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
				list_off();
	}
}

function list_off(){


		action = "list_off";
		if(layer1.style.display == 'none')
			hidd = "0";
		else
			hidd = "1";

		url = 'listAjax.php?action='+action+'&an=<?php echo $_GET["an"];?>&stat='+hidd;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("div_listoff").innerHTML = xmlhttp.responseText;

}

function drug_alert(drugcode){

	var return_drug_alert;

	xmlhttp = newXmlHttp();
	url = 'add_drug.php?action=drug_alert&drugcode='+ drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_alert = xmlhttp.responseText;
	return_drug_alert = return_drug_alert.substr(4);
	
	if(return_drug_alert != "0"){
		if(confirm(return_drug_alert)){
			return true;
		}else{
			return false;
		}
			
	}else{
		return true;
	}

}

function drug_interaction(drugcode){
	
	var return_drug_interaction;

	xmlhttp = newXmlHttp();
	url = 'add_drug.php?action=drug_interaction&drugcode='+ drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_interaction = xmlhttp.responseText;
	return_drug_interaction = return_drug_interaction.substr(4);

	if(return_drug_interaction != "0"){
		if(confirm(return_drug_interaction)){
			return true;
		}else{
			return false;
		}
			
	}else{
		return true;
	}

}

</SCRIPT>
</head>
<body>

<!-- div Drug List -->

<div id="slidemenubar2" style="left:-350" >
  
<layer id="slidemenubar"  >

<TABLE width="380" class="font_title"  bgcolor="#FFFFFF">
<TR>
	<TD valign="top" width="340">
	<BR>
<CENTER><A HREF="javascript: chang_layer(layer2);">ยาที่เคยจ่าย</A>&nbsp;<FONT COLOR="#000000">|</FONT>&nbsp;<A HREF="javascript: chang_layer(layer1); ">ยาที่เคย Off</A>&nbsp;<FONT COLOR="#000000">|</FONT>&nbsp;<A HREF="javascript: chang_layer(layer3); ">รายการยาเดิม</A></CENTER>
<BR>


<TABLE id="layer2" border = 1 bordercolor="#3300FF"  cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<CENTER>รายการยาที่เคยจ่าย</CENTER>
<TABLE>
<TR align="center" bgcolor="#3300FF" class="font_title">
	<TD width="200"><FONT COLOR="#FFFFFF"><B>รหัสยา</B></FONT></TD>
	<TD width="150"><FONT COLOR="#FFFFFF"><B>วิธีใช้</B></FONT></TD>
</TR>
<?php

$sql = "Select distinct drugcode, unit, tradname, slcode,part From dgprofile where an = '".$_GET["an"]."' AND statcon = 'STAT' AND date < '".(date("Y")+543)."".date("-m-d H:i:s")."' Order by date DESC limit 0,5 ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').options[1].selected = true;
	\" >",$arr["drugcode"],"</A></TD>
	<TD>",$arr["slcode"],"</TD>
</TR>";

}
Mysql_free_result($result);
?>
</TABLE>
</TD>
</TR>
</TABLE>
<div id="div_listoff">
<TABLE  id="layer1"  border = 1 bordercolor="#3300FF"  cellpadding="0" cellspacing="0" style="display:none">
<TR>
	<TD>
	<CENTER>รายการยาที่ OFF</CENTER>
<TABLE>
<TR align="center"  bgcolor="#3300FF" class="font_title">
	<TD width="150"><FONT  COLOR="#FFFFFF"><B>รหัสยา</B></FONT></TD>
	<TD width="100"><FONT COLOR="#FFFFFF"><B>วิธีใช้</B></FONT></TD>
	<TD width="50"><FONT COLOR="#FFFFFF"><B>จำนวน</B></FONT></TD>
	<TD width="50"><FONT COLOR="#FFFFFF"><B>ON</B></FONT></TD>
</TR>
<?php

$sql = "Select distinct drugcode, unit, tradname, slcode, amount,part From dgprofile where an = '".$_GET["an"]."' AND (onoff = 'OFF' AND statcon = 'CONT')  ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD>",$arr["drugcode"],"</TD>
	<TD>",$arr["slcode"],"</TD>
	<TD align=\"right\">",$arr["amount"],"</TD>
	<TD align=\"center\"><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').options[2].selected = true;
	document.getElementById('amount').value='",$arr["amount"],"'; add_session();\">ON</A></TD>
</TR>";

 }
 Mysql_free_result($result);
 ?>
</TABLE>
</TD>
</TR>
</TABLE>
</div>
<TABLE  id="layer3"  border = 1 bordercolor="#3300FF"  cellpadding="0" cellspacing="0" style="display:none">
<TR>
	<TD>
	<CENTER>รายการยาเดิม</CENTER>
<TABLE>
<TR align="center"  bgcolor="#3300FF" class="font_title">
	<TD width="150"><FONT  COLOR="#FFFFFF"><B>รหัสยา</B></FONT></TD>
	<TD width="100"><FONT COLOR="#FFFFFF"><B>วิธีใช้</B></FONT></TD>
</TR>
<?php

$sql = "Select distinct drugcode, unit, tradname, slcode,part From dgprofile where an = '".$_GET["an"]."' AND  statcon = 'OLD'  limit 0, 10 ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').options[1].selected = true;
	\" >",$arr["drugcode"],"</A></TD>
	<TD>",$arr["slcode"],"</TD>

</TR>";

 }
 Mysql_free_result($result);
 ?>
</TABLE>
</TD>
</TR>
</TABLE>
</TD>
	<TD align="center" width="40" bgcolor="#FFCC00" Onclick="pull_draw();">
	D<BR>R<BR>U<BR>G<BR><BR>L<BR>I<BR>S<BR>T
	</TD>
</TR>
</TABLE>

</layer>
</div>


<script language="JavaScript1.2">
	
	function chang_layer(ly){
	 layer1.style.display='none'; 
	 layer2.style.display='none';
	 layer3.style.display='none';
	 ly.style.display = '';
	}

	function regenerate(){
		window.location.reload()
	}

	function regenerate2(){
		if (document.layers)
		setTimeout("window.onresize=regenerate",400)
	}

	window.onload=regenerate2
	if (document.all){

		themenu=document.all.slidemenubar2.style
		rightboundary=0
		leftboundary=-350
	}else{
		themenu=document.layers.slidemenubar
		rightboundary=350
		leftboundary=10
	}
	
	function pull_draw(){

		if(themenu.pixelLeft == -350){
			pull();
		}else{
			draw();
			
		}
	}

	function pull(){
		if (window.drawit)
			clearInterval(drawit)
		pullit=setInterval("pullengine()",5)
	}

	function draw(){
		clearInterval(pullit)
		drawit=setInterval("drawengine()",5)
	}
	
	function pullengine(){
		if (document.all && themenu.pixelLeft < rightboundary)
			themenu.pixelLeft+=20
		else if(document.layers && themenu.left<rightboundary)
			themenu.left+=5
		else if (window.pullit)
			clearInterval(pullit)
	}

	function drawengine(){
		if (document.all && themenu.pixelLeft > leftboundary)
			themenu.pixelLeft-=20
		else if(document.layers && themenu.left > leftboundary)
			themenu.left-=5
		else if (window.drawit)
			clearInterval(drawit)
	}
</script>

<!-- div End Drug List -->

<?php
	
	$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '".$_GET["an"]."' limit 0,1 ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	Mysql_free_result($result);
	
	session_register("hn_now");
	$_SESSION["hn_now"] = $arr["hn"];
	session_register("an_now");
	$_SESSION["an_now"] = $arr["an"];
	$_SESSION["ptright_now"] = $arr["ptright"];
?>

<BR>
<TABLE align="center"  border="1" bordercolor="#3300FF" cellspacing="0" cellpadding="0" width="80%">
<TR>
	<TD>
<TABLE width="100%" align="center">
<TR bgcolor="#3300FF">
	<TD align="center" colspan="6"><FONT COLOR="#FFFFFF"><B>รายละเอียดผู้ป่วย</B></FONT></TD>
</TR>
<TR>
	<TD align="right">AN : </TD>
	<TD bgcolor="#FFFFBC"><a href="med_phar.php?fill_an=<?=$arr["an"];?>" target="_blank"><?=$arr["an"];?></a></TD>
	<TD align="right">HN : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["hn"];?></TD>
	<TD align="right">ชื่อ-สกุล : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptname"];?></TD>
</TR>
<TR>
	<TD align="right">หอผู้ป่วย : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $build[substr($arr["bedcode"],0,2)];?></TD>
	<TD align="right">สิทธิ์ : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptright"];?></TD>
	<TD align="right">แพทย์ : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["doctor"];?></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>

<TABLE align="center"   cellspacing="4" cellpadding="0" width="80%">
<TR>
	<TD>
		<?php 
			$sql = "Select drugcode,  tradname , advreact  From drugreact where hn = '".$arr["hn"]."' ";
			$result = Mysql_Query($sql);
			$rows = Mysql_num_rows($result);
			if($rows> 0){
				echo "<FONT COLOR=\"red\">แพ้ยาทั้งหมด ".$rows." รายการ<BR>";
				while(list($drugcode,  $tradname , $advreact) = Mysql_fetch_row($result)){
					echo "[",$drugcode,"] : ", $tradname , " อาการ : ",$advreact,"<BR>";
				}
				echo "</FONT>";
			}
		?>
	</TD>
</TR>
</TABLE>

<BR><BR>


	<TABLE align="center">
	<TR>
		<TD>รหัสยา : 
		</TD>
		<TD>
		<INPUT TYPE="text" ID = "drugcode" NAME="drugcode" size="13" onKeyPress="searchSuggest('drugcode',this.value); " onKeyDown="if(event.keyCode == 40 && document.getElementById('listdrugcode').innerHTML != ''){ document.getElementById('list_radio').focus(); document.getElementById('list_radio').checked=true ; return false;  }"
		onfocus="document.getElementById('listdrugcode').innerHTML = '';"
		>
		</TD>
		<TD>ชื่อยา : 
		</TD>
		<TD><INPUT TYPE="text" ID = "drugname" NAME="drugname"  size="20" onKeyPress="submit_button('drugcode');" onFocus="document.getElementById('listdrugcode').innerHTML = '';" readonly></TD>
		<TD>วิธีใช้ : 
		</TD>
		<TD><INPUT TYPE="text" ID = "drugslip" NAME="drugslip" size="10"  onkeypress="searchSuggest('drugslip',this.value);" onKeyDown="if(event.keyCode == 40 && document.getElementById('listdrugcode').innerHTML != ''){ document.getElementById('list_radio').focus(); document.getElementById('list_radio').checked=true ; return false;  }"
		onfocus="document.getElementById('listdrugcode').innerHTML = '';"
		></TD>
	</TR>
	<TR>
		<TD>จำนวน : 
		</TD>
		<TD><INPUT TYPE="text" ID="amount" NAME="amount" size="4"  onkeypress="submit_button('amount');" onFocus="document.getElementById('listdrugcode').innerHTML = '';">
		<BR><div id="listdrugcode" style="position: absolute;text-align: left; width:600px; height:100px; overflow:auto; "></div>
		</TD>
		<TD>หน่วย : 
		</TD>
		<TD><INPUT TYPE="text" ID="unit" NAME="unit"  size="5" onKeyPress="submit_button('amount');" onFocus="document.getElementById('listdrugcode').innerHTML = '';" readonly> 
		ประเภท:
		<INPUT TYPE="text" ID="unit2" NAME="unit2"  size="5"  onFocus="document.getElementById('listdrugcode').innerHTML = '';" readonly></TD>
		<TD>สถานะ : 
		</TD>
		<TD>
						<SELECT ID="statcon" NAME="statcon"  onkeypress="submit_button('statcon');" >
							<OPTION VALUE="" SELECTED>-- สถานะ --</OPTION>
							<OPTION VALUE="STAT1">STAT</OPTION>
							<OPTION VALUE="STAT">จ่ายวันเดียว</OPTION>
							<OPTION VALUE="CONT">ยา continuen</OPTION>
							<OPTION VALUE="OLD">ยาเดิม</OPTION>
						</SELECT>
		</TD>
	</TR>
	<TR>
		<TD colspan="6" align="center">
			<INPUT ID="button_submit" TYPE="button" VALUE=" ตกลง " ONCLICK="add_session();">
			<INPUT TYPE="button" VALUE=" เลือกผู้ป่วยใหม่ " ONCLICK="window.location.href='enddrugprofile.php';">
			<INPUT TYPE="button" VALUE=" ข้อมูลการจ่ายยา " ONCLICK="window.open('rp_profile.php?an=<?php echo $arr["an"];?>&month=<?php echo date("m");?>&year=<?php echo (date("Y")+543);?>&date=<?php echo date("dmy");?>','_blank');">
			
		</TD>
	</TR>
	</TABLE><BR>
	<div align="center"><a href="add_drugold.php?an=<?=$_GET["an"];?>" target="_blank">เพิ่มยาเดิม (นอกโรงพยาบาล)</a></div>
<BR><BR>

<CENTER>[ รายการยา ]</CENTER><BR>
<?php
	$sql = "Select date_format(date,'%d/%m/%Y') as dateform From dgprofile  where an = '".$_GET["an"]."' Order by date DESC limit 0,1 ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);

	echo "<DD>วันที่ปรับปรุงล่าสุด : ",$arr["dateform"],"<BR><BR>";
?>
<div id = "show_druglst">
<TABLE align="center"  border="1" bordercolor="#3300FF" cellspacing="0" cellpadding="0" width="85%">
<TR>
	<TD>
<TABLE width="100%">
<TR bgcolor="#3300FF" class="font_title" align="center">
	<TD>รหัสยา</TD>
	<TD>ชื่อยา</TD>
    <TD>ประเภท</TD>
	<TD>วิธีใช้</TD>
	<TD>จำนวน</TD>
	<TD>สถานะ</TD>
	<TD>OFF / ลบ</TD>
	<TD>แก้ไข</TD>
</TR>
<?php

$list_status_drug = array();

$list_status_drug["STAT1"] = "Stat";
$list_status_drug["STAT"] = "One day";
$list_status_drug["CONT"] = "Continue";
$list_status_drug["OLD"] = "ยาเดิม";


for($j=0;$j<$_SESSION["num_list"];$j++){

	if($_SESSION["list_druglst"]["statcon"][$j] == "CONT")
		$bgcolor = "#99FFFF";
	else
		$bgcolor = "#FFFFCC";
		
//$list_status_drug[$_SESSION["list_druglst"]["statcon"][$j]];
echo "
<TR bgcolor=\"",$bgcolor,"\">
	<TD>",$_SESSION["list_druglst"]["drugcode"][$j],"</TD>
	<TD>",$_SESSION["list_druglst"]["tradname"][$j],"</TD>
	<TD>",$_SESSION["list_druglst"]["part"][$j],"</TD>
	<TD><INPUT TYPE=\"text\" id=\"slcode",$j,"\" NAME=\"slcode",$j,"\" value=\"",$_SESSION["list_druglst"]["slcode"][$j],"\" size=\"6\"></TD>
	<TD ><INPUT TYPE=\"text\" id=\"amount",$j,"\" NAME=\"amount",$j,"\" value=\"",$_SESSION["list_druglst"]["amount"][$j],"\" size=\"3\"></TD>";
	?>
	<TD align="center">
    <select name="statusdrug<?=$j?>" id="statusdrug<?=$j?>">
    <option value="STAT1" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT1"){ echo "selected";}?>>Stat</option>
    <option value="STAT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT"){ echo "selected";}?>>One day</option>
    <option value="CONT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="CONT"){ echo "selected";}?>>Continue</option>
    <option value="OLD" <? if($_SESSION["list_druglst"]["statcon"][$j]=="OLD"){ echo "selected";}?>>ยาเดิม</option>
    </select></TD>
    <?
	
	echo "<TD align=\"center\">",(
		$_SESSION["list_druglst"]["row_id"][$j] != "" ? "<A HREF=\"javascript: del_session('".$j."','".$_SESSION["list_druglst"]["row_id"][$j]."');\">OFF</A>" : "<A HREF=\"javascript: del_session('".$j."','');\">ลบ</A>"
	),"</TD>
	<TD align=\"center\"><A HREF=\"javascript: edit_list('".$j."','".$_SESSION["list_druglst"]["row_id"][$j]."',document.getElementById('slcode",$j,"').value,document.getElementById('amount",$j,"').value,document.getElementById('statusdrug",$j,"').value);\">แก้ไข</A></TD>
</TR>

";

}	

?>
</TABLE>
</TD>
</TR>
</TABLE>
<?php
if($_SESSION["num_list"] > 0)
	echo "
	<FORM METHOD=POST ACTION=\"\">
	<CENTER><INPUT TYPE=\"submit\" Name=\"Save_dgprofile\"  VALUE=\"บันทึกข้อมูลใน DrugProfile\" ></CENTER>
	</FORM>";
?>
</div>

</body>
</html>
<?php
include("unconnect.inc");
?>