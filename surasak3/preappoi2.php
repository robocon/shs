<?php
session_start();

 if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");

if( !function_exists('dump') ){
	function dump($str){
		echo "<pre>";
		var_dump($str);
		echo "</pre>";
	}
}

if(isset($_GET["action"])  && $_GET["action"] == "viewlist"){

	$count = count($_SESSION["list_code"]);
	echo "<TABLE bgcolor='#FFFFD2'>
	<TR>
		<TD>";
	for($i=0;$i<$count;$i++){
		echo "<A HREF=\"javascript:del_list(",$i,");\" >",$_SESSION["list_detail"][$i],"</A><BR>";
	}
	echo "</TD>
	</TR>
	</TABLE>";

	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){

	//************************** �ʴ���¡�� lab  ********************************************************

	$array_new = array($_GET["code"]);

	$result = array_intersect($_SESSION["list_code"], $array_new);

	if(count($result) ==0){

	$sql = "Select detail, yprice, nprice From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	
	}

	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	$j=$_GET["code"];


	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];

	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);


	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:410px; height:430px; overflow:auto; \">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>��������´</strong></font></td>
			<td width=\"24\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></strong></font></td>
		</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";


				$arr["detail"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["detail"]);


			echo "<tr bgcolor=\"$bgcolor\">
					<td bgcolor=\"$bgcolor\"><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".$arr["code"]."'); \">",$arr["detail"],"</A></td>
					<td colspan=\"2\"  bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
				</tr>
					<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>
			";


		$i++;
		}
		echo "</TABLE></Div>";
	}

exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>㺹Ѵ������</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		
		// �óշ���ա�����͡ "������ʹ��辺ᾷ��" ��������ʴ� Ἱ�����¹
		$(document).on('change', '#detail', function(){
			if($(this).val() == 'FU14 ������ʹ��辺ᾷ��'){
				$('#opd').remove();
			}else{
				if($('#opd').length == 0){
					$('#pre-opd').after('<option id="opd">Ἱ�����¹</option>');
				}
			}
		});
	});
	</script>
</head>
<body>
<?php

if(isset($_POST['B1'])){
	$cdoctor = $dt_doctor;
	$cdate_appoint = $_POST['date_appoint'];
	// session_register("cappdate");
	// session_register("cappmo");
	// session_register("cthiyr");
	session_register("cdoctor");
	session_register("appd");

	//�ó����͡�ѹ�����͹��ѧ
	$yearnow = date("Y")+543;
	$datenow =date("dm").$yearnow;
	
	$mon = array('','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	$arr = explode (" ",$_POST['date_appoint']); 
	for($i=1;$i<13;$i++){
		if($arr[1]==$mon[$i]){
			if(strlen($i)==1) $month = "0".$i;
			else $month = $i;
		}
	}
	$day = $arr[0];
	$year = $arr[2];
	$datenut = $day.$month.$year;
	$datenut1 = $day."-".$month."-".$year;
	$year -=543; 
	
	$dd = getdate ( mktime ( 0, 0, 0, $month, $day, $year ));
	if($cdoctor=="MD022 (����Һᾷ��)"){
	
	}elseif($dd['weekday']=="Saturday"|$dd['weekday']=="Sunday"){
		$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
		$rowdr1 = mysql_query($droffline);
		$showdr1 = mysql_fetch_array($rowdr1);
		if($showdr1[0]=="1"){
			?>
				<script type="text/javascript">
					var c = confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?");
					if( c == false){
						window.history.back();
					}
				</script>
			<?php
		}
	}else{
		include("connect.inc");   
		$droff = "select count(*) from doctor where name = '$cdoctor' and ".$dd['weekday']." = '1' ";
		$rowdr = mysql_query($droff);
		$showdr = mysql_fetch_array($rowdr);
		if($showdr[0]!='1'){
			?>
			<script>
				if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
					
				}  
				else{
					window.history.back();
				}
			</script>
			<?
		}else{
			$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
			$rowdr1 = mysql_query($droffline);
			$showdr1 = mysql_fetch_array($rowdr1);
			if($showdr1[0]=="1"){
				?>
					<script>
						if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
							
						}  
						else{
							window.history.back();
						}
					</script>
				<?
			}
		}
	}
}

$cappdate = $appdate;
$cappmo = $appmo;
$cthiyr = $thiyr;
$cdoctor = $doctor;
$cdate_appoint = $_POST['date_appoint'];

session_register("cappdate");
session_register("cappmo");
session_register("cthiyr");
session_register("cdoctor");
session_register("appd");
session_register("list_code");
session_register("list_detail");

$_SESSION["list_code"] = array();
$_SESSION["list_detail"] = array();

 function jschars($str){
	$str = str_replace("\\\\", "\\\\", $str);
	$str = str_replace("\"", "\\\"", $str);
	//$str = str_replace("'", "\\'", $str);
	$str = str_replace("\r\n", "\\n", $str);
	$str = str_replace("\r", "\\n", $str);
	$str = str_replace("\n", "\\n", $str);
	$str = str_replace("\t", "\\t", $str);
	$str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
	$str = str_replace(">", "\\x3E", $str);
	return $str;
}

$codedr = substr($cdoctor,0,5);
//$arrdr1 = array(MD052,MD006,MD013,MD014);
$arrdr2 = array('MD008','MD009','MD007','MD072','MD036','MD041','MD016','MD047','MD088');
if(in_array($codedr,$arrdr2)){
	$counter='2'; //�ش�Ѵ��� 2
}else{
	$counter = '1'; //�ش�Ѵ��� 1
}

//$dbirth="$y-$m-$d"; ���ѹ�Դ� opcard= "$y-$m-$d" ���=$birth in function
// print "<p><b><font face='Angsana New' size = '3'>�ç��Һ�Ť�������ѡ��������</font></b></p>";
print "<p><font face='Angsana New' size = '4'>���� $cPtname  HN: $cHn ���� $cAge &nbsp;<B>�Է��:$cptright:$idguard</font></B><br>";
print "<font face='Angsana New' size = '4'>ᾷ�� $cdoctor �ѹ���: $cdate_appoint&nbsp; </font></B></p>";
$queryT="SELECT phone FROM opcard where hn='$cHn'";
$resultT = mysql_query($queryT);
$rowT = mysql_fetch_array($resultT);

$appd=$cdate_appoint;
 
$SqlStr = "SELECT  *  FROM  appoint  WHERE  hn = '".$cHn."' and doctor = '".$cdoctor."' and appdate ='".$cdate_appoint."' ";
$OjbQuery = mysql_query($SqlStr);
$OjbRow=mysql_num_rows($OjbQuery);
$Array=mysql_fetch_array($OjbQuery);
if($Array['patho']==""){
	$Array['patho']="-";
}
if($Array['xray']==""){
	$Array['xray']="-";
}
if($Array['other']==""){
	$Array['other']="-";
}
if($OjbRow>0){
	?>
	<div style="background-color:#F99; font-family: TH SarabunPSK; color: #000000; font-size: 20pt; padding: 4px; border: 1px solid #ad0000;">
		<p style="margin: 0;">�������ա�ùѴ� �ѹ��� <?=$Array['appdate'];?> ����  <?=$Array['apptime'];?>  ��� ᾷ��:  <?=$Array['doctor'];?></p>
		<p style="margin: 0;">LAB: <?=$Array['patho'];?></p>
		<p style="margin: 0;">Xray: <?=$Array['xray'];?></p>
		<p style="margin: 0;">����: <?=$Array['other'];?></p>
	</div>
	<?php
}

// �ʴ��ӹǹ�����·��Ѵ
$query = "CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' and doctor = '$cdoctor' ";
$result = mysql_query($query) or die("Query failed,app");
$query = "SELECT  apptime,COUNT(*) AS duplicate FROM appoint1 GROUP BY apptime HAVING duplicate > 0 ORDER BY apptime";
$result = mysql_query($query);
$n = 0;
$sum_morning = 0;
$sum_afternoon = 0;
while (list ($apptime, $duplicate) = mysql_fetch_row ($result)) {
	$n++;
	$num = ( $duplicate + $num );

	preg_match('/\d+\:\d+/', $apptime, $match);
	$time_appoint = $match['0'];
	if( $time_appoint < "12:00" && $apptime !== '¡��ԡ��ùѴ' ){
		$sum_morning += $duplicate;
	}elseif( $time_appoint >= "12:00" && $apptime !== '¡��ԡ��ùѴ' ){
		$sum_afternoon += $duplicate;
	}

	?>
	<div style="font-family: Angsana New;">
		<b><?=$apptime;?></b>&nbsp;&nbsp;�Ѵ�ӹǹ&nbsp; = &nbsp;<?=$duplicate;?> &nbsp;&nbsp;��
	</div>
	<?php
}
?>
<br>
<font face="Angsana New" style="font-size: 24px;"><b>�ӹǹ�����·�����&nbsp;&nbsp;<?=$num;?>&nbsp;&nbsp;��</b>
<div style="font-family: Angsana New; font-size: 24px;"><b>��������¹Ѵ��ǧ���</b>: <?=$sum_morning;?> ��</div>
<div style="font-family: Angsana New; font-size: 24px;"><b>��������¹Ѵ��ǧ����</b>: <?=$sum_afternoon;?> ��</div>
<script type="text/javascript">

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

function addtolist(code){
	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();
}

function viewlist(){
	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=viewlist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("list_patho").innerHTML = xmlhttp.responseText;
	document.getElementById("list").innerHTML = "";
}

function del_list(code){
	url = 'preappoi2.php?action=delete&code=' + code;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();
}

function show_bock(){
	if(document.getElementById("bock_lab").style.display=="none"){
		document.getElementById("bock_lab").style.display ="";
	}else{
		document.getElementById("bock_lab").style.display ="none";
	}
}

function listb(number){
	
	if(document.getElementById("detail").value!='FU05 ��ҵѴ'){
		document.getElementById("setor").style.display='none';
	}

	if(document.getElementById("detail").value=='FU01 ��Ǩ����Ѵ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU02 ����ŵ�Ǩ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU03 �͹�ç��Һ��'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU04 �ѹ�����'){
		document.getElementById("room").selectedIndex=5;
	}
	else if(document.getElementById("detail").value=='FU05 ��ҵѴ'){
		document.getElementById("room").selectedIndex=3;
		document.getElementById("setor").style.display='block';
	}
	else if(document.getElementById("detail").value=='FU06 �ٵ�'){
		document.getElementById("room").selectedIndex=8;
	}
	else if(document.getElementById("detail").value=='FU07 ��չԡ�ѧ���'){
		document.getElementById("room").selectedIndex=10;
	}
	else if(document.getElementById("detail").value=='FU08 Echo'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU09 ��š�д١'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU10 ����Ҿ'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU11 ��Ǩ����Ѵ���������ѵԼ������'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU12 �ǴἹ��'){
		document.getElementById("room").selectedIndex=11;
	}
	else if(document.getElementById("detail").value=='FU20 ��ͧ������(��Թԡ�����)'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU14 ������ʹ��辺ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU15 OPD �͡����'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU16 ��Թԡ�����'){
		document.getElementById("room").selectedIndex=0;
	}
	else if(document.getElementById("detail").value=='FU17 X-ray ��辺ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU18 �Ѵ������ ER ��辺ᾷ��'){
		document.getElementById("room").selectedIndex=4;
	}
	else if(document.getElementById("detail").value=='FU19 ��ŵ��ҫ�Ǵ�'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU21 ��Թԡ COPD'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�'){
		document.getElementById("room").selectedIndex=14;
	}
	else if(document.getElementById("detail").value=='FU23 OPD ����Ҿ'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU24 ��Ǩ����Ѵ OPD �ѡ��(��)'){
		document.getElementById("room").selectedIndex=12;
	}
	else if(document.getElementById("detail").value=='FU25 CT Scan'){
		document.getElementById("room").selectedIndex=0;
	}
	else if(document.getElementById("detail").value=='FU26 EMG'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU27 X-ray ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU28 Lab ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU29 X-ray + Lab ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU30 ��Թԡ�ä�'){
		document.getElementById("room").selectedIndex=15;
	}
	else if(document.getElementById("detail").value=='FU13 ��Ǩ�к��ҧ�Թ�����'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		document.getElementById("detail_list").style.display ="block";
		document.getElementById("detail2").style.display ="none";
	}
	else{
		document.getElementById("detail2").style.display ="block";
		document.getElementById("detail_list").style.display ="none";
	}
}

function searchSuggest(action,str,len) {
	
	str = str+String.fromCharCode(event.keyCode);

	if(str.length >= len){
		url = 'preappoi2.php?action='+action+'&search=' + str;

		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		document.getElementById('list').style.display=''
		document.getElementById("list").innerHTML = xmlhttp.responseText;
	}
}

function checktext(){
	if(document.getElementById('room').value=="NA"){
		alert('��س����͡��ͧ\"���㺹Ѵ���\"');
		return false;
	}
	else if(document.getElementById('detail').value=="NA"){
		alert('��س����͡��ͧ\"�Ѵ������\"');
		return false;
	}
	else if(document.getElementById('advice').value=="NA"){
		alert('��س����͡��ͧ\"��ͤ�û�Ժѵԡ�͹��ᾷ��\"');
		return false;
	}
	else if(document.getElementById('depcode').value=="NA"){
		alert('��س����͡��ͧ\"Ἱ����Ѵ\"');
		return false;
	}
	return true;
}

</script>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;
	window.onload = function () {
		dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));
	};

/* 㺹Ѵʵ������ */
function fncSubmit(strPage){
	var testForm = checktext();
	if( testForm === true ){
		if(strPage == "page1"){
			document.form1.action = "appinsert_stricker.php";
		}
		document.form1.submit();
	}
}
</script>

<TABLE border="0">
	<TR valign="top">
		<TD>
			<form  name="form1" method="POST" action="appinsert1.php" target="_blank" onSubmit="return checktext();">
				<font face="Angsana New" size = '4'>��س��кء�ùѴ������ ���ͷ��Ἱ�����¹�зӡ�ä��� OPD Card ��١��ͧ
				<br>

<table border="0">
	<tr>
		<td>
			<font face="Angsana New">�Ѵ������&nbsp;&nbsp;&nbsp;</font>
		</td>
		<td width="311">
			<font face="Angsana New">
			<select size="1" name="detail" onChange="listb(<?=$counter?>)" id="detail">
				<?php if($_SESSION["sOfficer"]!="����ѵ�� �������"){ ?>
				<option value="NA"><<�Ѵ������>></option>  
				<?php } ?>
				<?php
				if($_SESSION["sOfficer"]=="����ѵ�� �������"){
					$app = "select * from applist where status='Y' and applist ='��š�д١'";
				}else{
					$app = "select * from applist where status='Y' ";
				}
				$row = mysql_query($app);
				
				while($result = mysql_fetch_array($row)){
					$str="";
					if($result['applist']=="��Ǩ����Ѵ���������ѵԼ������"){
						$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
						$result1 = Mysql_Query($sql1);
						$arr = Mysql_fetch_row($result1);
						if($arr[0] == "ADMICU" || $arr[0] == "ADMWF" || $arr[0] == "ADMVIP" || $arr[0] == "ADMOBG"){
							$str = "  Selected  ";
						}
					}
					?>
					<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
					<?php
				}
				?>
			</select>
			</font>
		</td>
		<td width="280">
			<font face="Angsana New">
			<input type="text" id="detail2" name="detail2" size="20">
			<select size="1" name="detail_list" id="detail_list" style="display:none">
				<option value="��ͧ�����������">��ͧ�����������</option>
				<option value="��ͧ������˭�">��ͧ������˭�</option>
				<option value="��ͧ�����������+��ͧ������˭�">��ͧ�����������+��ͧ������˭�</option>
			</select>
			</font>
		</td>
	</tr>
	<tr style="display:none" id="setor">
		<td>&nbsp;</td>
		<td colspan="2">
		<fieldset><legend>�૵��ҵѴ</legend>
		<table width="363">
			<tr>
				<td width="64">�ѹ/��͹/��</td><td width="287"><input type="text" name="date_surg" id="date_surg" size="10">
					����
					<select name="time1">
						<option value="-" selected="selected">-</option>
						<?php 
							for($i=0;$i<=23;$i++){ 
								echo "<Option value=\"".sprintf('%02d',$i)."\" ";
								echo ">".sprintf('%02d',$i)."</Option>";
							}
						?>
					</select>
					:
					<select name="time2">
						<option value="-" selected="selected">-</option>
						<?php 
							for($i=0;$i<=59;$i=$i+5){ 
								echo "<Option value=\"".sprintf('%02d',$i)."\" ";
								echo ">".sprintf('%02d',$i)."</Option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>����ԹԨ���</td>
				<td>
					<font face="Angsana New">
						<input type="text" id="ordetail1" name="ordetail1" size="30" />
					</font>
				</td>
			</tr>
			<tr><td>��ü�ҵѴ</td><td><font face="Angsana New">
				<input type="text" id="ordetail2" name="ordetail2" size="30" />
				</font>
			</td></tr>
			<tr><td>��Դ����</td><td><font face="Angsana New">
				<input type="text" id="ordetail3" name="ordetail3" size="30" />
				</font>
			</td></tr>
			<tr><td>�����˵�</td><td><font face="Angsana New">
				<textarea name="ordetail4" cols="30" rows="4" id="ordetail4"></textarea>
				</font>
			</td></tr>
    	</table>
    </fieldset>
    </td>
    </tr>

  <tr>
    <td width="115"><font face="Angsana New" size = '4'><font face="Angsana New">���㺹Ѵ���</font></font></td>
    <td colspan="2"><font face="Angsana New" size = '4'><font face="Angsana New">
      <select size="1" name="room" id="room">
        <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
        <option>�ش��ԡ�ùѴ��� 1</option>
        <option id="pre-opd">�ش��ԡ�ùѴ��� 2</option>
        <option id="opd">Ἱ�����¹</option>
        <option>��ͧ�ء�Թ</option>
        <option>�ͧ�ѹ�����</option>
        <option>Ἱ���Ҹ��Է��</option>
        <option>Ἱ��͡�����</option>
        <option>�ͧ�ٵ�-����</option>
        <option>����Ҿ</option>
        <option>��չԡ�ѧ���</option>
        <option>�ǴἹ��</option>
        <option>��ͧ��Ǩ�ѡ��(��)</option>
        <option>��ͧ��Ǩ����Ҿ�ӺѴ(�֡����Ҿ)</option>
        <option>��Ǩ����Ѵ OPD�Ǫ��ʵ���鹿�</option>
        <option>��չԡ�ä�</option>
		<option>����Ҿ�ӺѴ��� 2</option>
         <option>��ͧ CT SCAN</option>       
        <? if($_SESSION["sOfficer"]=="����ѵ�� �������"){?>
        <option selected="selected">��ͧ CT SCAN (��Ǩ��š�д١)</option>
        <? } ?>
        </select>
      </font><font face="Angsana New" size = '4'><font face="Angsana New"></font></font></font><font face="Angsana New" size = '4'><font face="Angsana New">����<?php if($_SESSION["sIdname"]== '�ѧ���' || $_COOKIE["until"] == "�ѧ���"){
	   
	   if(empty($_COOKIE["until"])){
		 @setcookie("until", "�ѧ���", time()+(3600*12));
	   }

	   ?>
        <select size="1" id="capptime" name="capptime">
          <option value="07:30 �. - 08:00 �.">07:30 �. - 08:00 �.</option>
          <option value="08:30 �. - 09:00 �.">08:30 �. - 09:00 �.</option>
          <option value="09:30 �. - 10:00 �.">09:30 �. - 10:00 �.</option>
          <option value="10:30 �. - 11:00 �.">10:30 �. - 11:00 �.</option>
          <option value="11:30 �. - 12:00 �.">11:30 �. - 12:00 �.</option>
          <option value="12:30 �. - 13:00 �.">12:30 �. - 13:00 �.</option>
          <option value="15:30 �. - 16:00 �.">15:30 �. - 16:00 �.</option>
          <option value="16:30 �. - 17:00 �.">16:30 �. - 17:00 �.</option>
          <option value="17:30 �. - 18:00 �.">17:30 �. - 18:00 �.</option>
          <option value="18:30 �. - 19:00 �.">18:30 �. - 19:00 �.</option>
          </select>
         <? }else if($_SESSION["sOfficer"]=="����ѵ�� �������"){ ?>
        <select size="1" id="capptime" name="capptime">
          <option value="09:30 �.">09:30 �.</option>
          <option value="13:30 �.">13:30 �.</option>
          </select>         
        <?php }else{ ?>
        <select size="1" id="capptime" name="capptime">
          <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
          <option selected>08:00 &#3609;. - 10.00 &#3609;.</option>
          <option>08:00 &#3609;. - 11.00 &#3609;.</option>
          <option>07:00 &#3609;.</option>
          <option>07:30 &#3609;.</option>
          <option>08:00 &#3609;.</option>
          <option>08:30 &#3609;.</option>
          <option>09:00 &#3609;.</option>
          <option>09:30 &#3609;.</option>
          <option>10:00 &#3609;.</option>
          <option>10:30 &#3609;.</option>
          <option>11:00 &#3609;.</option>
          <option>11:30 &#3609;.</option>
          <option>12:30 &#3609;.</option>
          <option>13:00 &#3609;.</option>
          <option>13:30 &#3609;.</option>
          <option>14:00 &#3609;.</option>
          <option>14:30 &#3609;.</option>
          <option>15:00 &#3609;.</option>
          <option>15:30 &#3609;.</option>
          <option>16:00 &#3609;.</option>
          <option>16:30 &#3609;.</option>
          <option>17:00 &#3609;.</option>
          <option>17:30 &#3609;.</option>
          <option>18:00 &#3609;.</option>
          <option>18:30 &#3609;.</option>
          <option>19:00 &#3609;.</option>
          <option>19:30 &#3609;.</option>
          <option>20:00 &#3609;.</option>
          <option>21:00 &#3609;.</option>
          </select>
        <?php } ?>
      </font></font></td>
    </tr>
<tr>
  <td colspan="3"><font face="Angsana New"><A HREF="javascript:show_bock();">������ʹ</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������ʹ������� <font face="Angsana New">
    <input type="text" name="labm" size="30" />
  </font></td>
  </tr>
 
<tr>
  <td colspan="3"><div id="list_patho"></div></td>
</tr>
<tr>
  <td><font face="Angsana New">�͡�����&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <select size="1" name="xray">
      <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;&#3585;&#3634;&#3619;&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;</option>
      <option>CXR</option>
      <option>KUB</option>
      <option>�͡����� ��͹��ᾷ��</option>
      &nbsp;
      </select>
    </font><font face="Angsana New">
      <input type="text" name="xray2" size="30" />
    </font></td>
  </tr>
<tr>
  <td><font face="Angsana New">����&nbsp;&nbsp;</font></td>
  <td><font face="Angsana New">
    <input type="text" name="other" size="30" />
  </font></td>
  <td>&nbsp;</td>
</tr>
 <tr>
  <td>��ͤ�û�Ժѵԡ�͹��ᾷ��</td>
  <td colspan="2"><font face="Angsana New" size = '4'>
  <? if($_SESSION["sOfficer"]=="����ѵ�� �������"){ ?>
     <select size="1" name="advice" id="advice">
      <option value="�����" selected="selected">�����</option
      ></select> 
  <? }else{ ?>
    <select size="1" name="advice" id="advice">
      <option selected value="NA">&lt;&#3650;&#3611;&#3619;&#3604;&#3648;&#3621;&#3639;&#3629;&#3585;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&gt;</option>
      <option value="�����">�����</option>
      <option>����ͧ��������������</option>
      <option>�������ҹ����������ѧ���� 20:00 �.(���������������)</option>
      <option>�������ҹ����������ѧ���� 24:00 �.(���������������)</option>
      <option>���������������ѧ���� 20:00 �.</option>
      <option>���������������ѧ���� 24:00 �.</option>
      <option>���������������ѧ���� .............. �.</option>
      <option>�͡����� ��͹��ᾷ��</option>
      <option>������������ͧ��дѺ�ء��Դ �����Ū�� �駺���ǳ�鹤� ᢹ ��Т�</option>
	  <option value="�纻�����觵�Ǩ��͹��ᾷ��">�纻�����觵�Ǩ��͹��ᾷ��</option>
      </select>
      <? } ?>
  </font></td>
  </tr>

<tr>
  <td><font face="Angsana New">Ἱ����Ѵ</font></td>
  <td><font face="Angsana New">
    <select size="1" name="depcode" id="depcode">
    <? if($_SESSION["sOfficer"]!="����ѵ�� �������"){?>
      <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&gt;</option>
      <? } ?>
      <option>U09&nbsp;
        ��ͧ��Ǩ�ä</option>
      <option>U01&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
      <option>U02&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
      <option>U03&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
      <option>U19&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
      <option>U04&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
      <option>U05&nbsp;
        &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
      <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
      <option>U12&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>
      <option>U10&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
      <option>U11&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
      <option>U13&nbsp;
        &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
      <option>U16&nbsp;
        &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
      <option>U19&nbsp; �ͧ��Ǩ�ä�������ٵ�</option>
      <option>U20&nbsp; ����Ҿ</option>
      <option>U21&nbsp; �ǴἹ��</option>
      <option>U22&nbsp; ��ͧ��Ǩ�ѡ��(��)</option>
      <option>U23&nbsp; ��ͧ��Ǩ�Ǫ��ʵ���</option>
      <option>U24&nbsp; ��Թԡ�ѧ���</option>
      <option>U25&nbsp; CT Scan</option>
       <option>U26&nbsp; ��Թԡ�ä�</option>
       <option>U27&nbsp; OPD PM&R</option>
		<?php if($_SESSION["sOfficer"]=="����ѵ�� �������"){ ?>
		<option selected="selected">U28&nbsp; ��Ǩ��š�д١</option>
		<?php } ?>
		</select>
		</font>
	</td>
	<td>&nbsp;</td>
</tr>
	<tr>
		<td><font face="Angsana New">�������Ѿ�������</font></td>
		<td>
			<font face="Angsana New">
				<input type="text" name="telp" size="20" value="<?=$rowT['phone']?>" />
			</font>
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
			<font face="Angsana New">*��Ҽ���������¹�ŧ�����Ţ���Ѿ������͡�����Ţ���Ѿ������᷹�����Ţ���</font>
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="left" width="100%">
<?php

$months = array(
	'���Ҥ�' => '01', '����Ҿѹ��' => '02','�չҤ�' => '03', '����¹' => '04','����Ҥ�' => '05', '�Զع�¹' => '06',
	'�á�Ҥ�' => '07', '�ԧ�Ҥ�' => '08','�ѹ��¹' => '09', '���Ҥ�' => '10','��Ȩԡ�¹' => '11', '�ѹ�Ҥ�' => '12'
);

$th_day = array( 0 => '�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����' );

// �Ѻ�ӹǹ���Ѵ�����·�����
list($code, $dr_name) = explode(' ', $_POST['doctor']);
$date_appoint = trim($_POST['date_appoint']);
$sql = "SELECT `hn`,`apptime`
FROM `appoint` 
WHERE `appdate` = '$date_appoint' 
AND `doctor` LIKE '$code%' 
AND `apptime` != '¡��ԡ��ùѴ';";
$query = mysql_query($sql);
$rows = mysql_num_rows($query);

// �觵���Ѵ���-����
$appoint_morning = 0;
$appoint_afternoon = 0;
while ( $item = mysql_fetch_assoc($query) ) {

	// �� format xx:xx �ͧ����
	$match = preg_match('/\d+\:\d+/', $item['apptime'], $matchs);
	if( $match > 0 ){
		$time_appoint = $matchs['0'];

		// �Ѻ�ӹǹ��Һ���
		if( $time_appoint < "12:00" ){
			$appoint_morning++;
		}elseif( $time_appoint >= "12:00" ){
			$appoint_afternoon++;
		}
	}
	
}

// �ҵ��˹觢ͧ�ѹ�ҡ $date_appoint
list($day, $th_month, $th_year) = explode(' ', $date_appoint);
$new_date = ( $th_year - 543 ).'-'.$months[$th_month].'-'.$day;
$check_date = date('w', strtotime($new_date));

// �硡Ѻ���ҧ���ӡѴ�Ѵ
$sql = "SELECT `dr_name`,`allday`,`date`,`user_row`,`morning`,`afternoon` 
FROM `dr_limit_appoint` 
WHERE `dr_name` LIKE '$code%' 
AND `date` = '$check_date'";
$query = mysql_query($sql);
$item = mysql_fetch_assoc($query);
$dr_limit_row = mysql_num_rows($query);
dump($item);
$allday = (int) $item['allday'];
$dr_limit = (int) $item['user_row'];
$limit_morning = (int) $item['morning'];
$limit_afternoon = (int) $item['afternoon'];

// ����͹�����š�èӡѴ�Ѵ(����բ�����)
if( $dr_limit_row > 0 ){
	?>
	<div style="border: 1px solid #c1bb00; text-align: center; background-color: #fffc99; margin-bottom: 4px;">
		<p style="margin: 0;">�ӡѴ��ùѴ�ͧ <?=$item['dr_name'];?></p>
		<?php
		if( $allday === 1 ){
			?>
			<p style="margin: 0;">�ѹ<?=$th_day[$check_date];?>����Թ <?=$dr_limit;?> ��</p>
			<?php
		}else{
			?>
			<p style="margin: 0;">�ѹ<?=$th_day[$check_date];?> ��ǧ�������Թ <?=$limit_morning;?> �� ��Ъ�ǧ��������Թ <?=$limit_afternoon;?> ��</p>
			<?php
		}
		?>
	</div>
	<?php
	$display = '';
	// ��ҨӡѴẺ����ѹ
	if( $allday > 0 && $rows >= $dr_limit ){
		
		$get_day = (int) $item['date'];
		?>
		<span style="color: red;">
			�ѹ<?=$th_day[$get_day];?> ��� <?=$day;?> ��͹ <?=$th_month.' '.$th_year;?> �ʹ�Ѵ�����¢ͧ��� <?=$item['dr_name'];?> ������Ƿ�� <?=$dr_limit;?> ��
		</span>
		<br>
		<a href="javascript: void(0);" onclick="window.history.back();return false;">��ԡ�����</a> ���͡�Ѻ�����¹�ѹ�Ѵ����
		<?php
		$display = 'style="display: none;"';
	}
	/*else{
		?>
		<input name="B1" type="submit" class="checkTimeRange" value="     ��ŧ (A5)    " />
		<!-- onClick="JavaScript:fncSubmit('page1')" -->
		<input name="btnButton1" type="button" class="checkTimeRange" data="sticker" value="��ŧ (㺹Ѵʵ������)" >
		<?php
	}
	*/
}

?>
<input name="B1" type="submit" class="checkTimeRange" value="     ��ŧ (A5)    " <?=$display;?>/>
<!-- onClick="JavaScript:fncSubmit('page1')" -->
<input name="btnButton1" type="button" class="checkTimeRange" data="sticker" value="��ŧ (㺹Ѵʵ������)" <?=$display;?> >

<script type="text/javascript">
$(function(){

	// ���� button ���� input �ѹ�� onclick ʤ�Ի�зӧҹ��ѧ eventhandler
	$(document).on('click', '.checkTimeRange', function(ev){
		
		// 㺹Ѵʵ������
		var sticker = $(this).attr('data');
		
		// �Ѵ੾�����ҵ���á
		var apptime = $('#capptime').val();
		var patt = /\d+\:\d+/;
		var testmatch = patt.exec(apptime);
		
		var dr_limit_row = parseInt('<?=$dr_limit_row;?>');

		// �ѴẺ����ѹ?
		var allday = parseInt('<?=$allday;?>');

		// �ӹǹ�Ѵ�����к���
		var appoint_morning = parseInt('<?=$appoint_morning;?>');
		var appoint_afternoon = parseInt('<?=$appoint_afternoon;?>');

		// �ӹǹ���ӡѴ�����к���
		var limit_morning = parseInt('<?=$limit_morning;?>');
		var limit_afternoon = parseInt('<?=$limit_afternoon;?>');

		if( dr_limit_row > 0 && allday === 0 ){
			if( testmatch['0'] < "12:00" && appoint_morning >= limit_morning ){
				alert('��ǧ��ҹѴ������� ��س����͡��ǧ���� ��������¹�ѹ�Ѵ');
				ev.preventDefault();
				return false;
			}else if( testmatch['0'] > "12:00" && appoint_afternoon >= limit_afternoon ){
				alert('��ǧ���¹Ѵ������� ��س����͡��ǧ��� ��������¹�ѹ�Ѵ');
				ev.preventDefault();
				return false;
			}
		}
		
		// ��Ҥ�ԡ�ҡ �͡㺹Ѵʵ������
		if( typeof(sticker) != 'undefined' ){
			fncSubmit('page1');
		}

	});
});
</script>
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
</font>
<br />
</p>
	<input type="hidden" name="appd" value="<?php echo $appd; ?>">
</form>

&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; ����</a>&| <a target=_self  href='hnappoi1.php'>&lt;&lt; �͡㺹Ѵ����</a>
</TD>
	<TD>
	
	<?php
$i=0;
$sql2 = "select * from labcare where lab_list !=0 order by lab_list asc";
$rows2=mysql_query($sql2);
while($result2=mysql_fetch_array($rows2)){	
	$list_lab_check[$i]["code"] = $result2['code'];
	$list_lab_check[$i]["detail"] = $result2['lab_listdetail'];
	$i++;
}

	$r=5;
	$count = count($list_lab_check);

?>

<TABLE id="bock_lab" width="100%" border="1" bordercolor='#000000' cellpadding="3" cellspacing="0" style="display:none;">
<TR valign="top">
	<TD width="500">
	<CENTER><B>��¡�õ�Ǩ�ҧ��Ҹ�</B></CENTER>
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >��ǨLAB ���� �к� : <INPUT TYPE="text" NAME="" size="13" onKeyPress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		
		echo "<TD valign='top'><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".jschars($list_lab_check[$i-1]["code"])."');\" >".jschars($list_lab_check[$i-1]["detail"])."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}
?>
</TR>
<TR>
	<TD colspan="<?php echo $r*2;?>">
		<?php
		?>
	</TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE>
</body>
</html>
<?php  include("unconnect.inc");?>