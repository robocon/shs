<?php
if(isset($_GET["action"]) && ($_GET["action"] == "view" || $_GET["action"] == "view_inj" )){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");

$days = array();
for($i=1; $i<=31; $i++){
	$i = (strlen($i) == 1) ? "0$i" : $i ; 
	$days[$i] = $i;
}

$month = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
);

$years = array();
$year = date('Y')+543;
$min_y = $year - 5;
$max_y = $year + 5;
for($min_y; $min_y < $max_y; $min_y++){
	$years[] = $min_y;
}



if(isset($_GET["action"]) && $_GET["action"] == "view"){
	
	$sql = "Select concat(yot,' ',name,' ',surname) as fullname, ptright, idcard, dbirth  From opcard where hn = '".$_GET["hn"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname, $ptright,$idcard,$dbirth) = Mysql_fetch_row($result);
	echo $fullname,"&nbsp;&nbsp;", $ptright;
	echo "<INPUT TYPE=\"hidden\" Name=\"fullname\" Value=\"".$fullname."\"><INPUT TYPE=\"hidden\" Name=\"ptright\" value=\"".$ptright."\"><INPUT TYPE=\"hidden\" Name=\"idcard\" value=\"".$idcard."\"><INPUT TYPE=\"hidden\" Name=\"dbirth\" value=\"".$dbirth."\">";
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "view_inj"){
$_GET['y'] = $_GET['y']-543;

	if($_GET["druginj"] == "VERORAB 2" || $_GET["druginj"] == "VERORAB 3" || $_GET["druginj"] == "VERORAB 5"){
	echo "<TABLE width='300' cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
		<TR align='center'>
			<TD>วันที่นัดฉีด</TD>
		</TR>";

	$num[0] = 0;
	$num[1] = 3;
	$num[2] = 7;
	$num[3] = 14;
	$num[4] = 30;
	$num[5] = 90;

	switch($_GET["druginj"]){
		case "VERORAB 2" : $count = 2; break;
		case "VERORAB 3" : $count = 3; break;
		case "VERORAB 5" : $count = 5; break;
	}

	for($i=0;$i<$count;$i++){
		
		echo "<TR><TD align='center'>";
		$get_time = mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']);
		$dcheck = date('d', $get_time);
		$mcheck = date('m', $get_time);
		$ycheck = date('Y', $get_time)+543;
		?>
		<select class="change-date" name="day[]">
			<?php foreach($days as $key => $day){ ?>
			<?php $checked = ( $dcheck==$key ) ? 'selected' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $checked;?>><?php echo $day;?></option>
			<?php } ?>
		</select>
		
		<select class="change-date" name="month[]">
			<?php foreach($month as $key => $m){ ?>
			<?php $checked = ( $mcheck==$key ) ? 'selected' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $checked;?>><?php echo $m;?></option>
			<?php } ?>
		</select>
		
		<select class="change-date" name="year[]">
			<?php foreach($years as $key => $y){ ?>
			<?php $checked = ( $ycheck==$y ) ? 'selected' : '' ;?>
			<option value="<?php echo $y;?>" <?php echo $checked;?>><?php echo $y;?></option>
			<?php } ?>
		</select>
		<?php
		echo "</TD></TR>";
			
		// echo date('d ',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y'])),'&nbsp;',
		// $month[date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']))],'&nbsp;',
		// date(' Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']))+543;
		
		
		
		echo "<INPUT TYPE=\"hidden\" class='verorab$i' name=\"list_date[]\" value=\"".(date(' Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']))+543)."-".(date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y'])))."-".(date('d ',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y'])))."\">";

		echo "<INPUT TYPE=\"hidden\" name=\"list_date2[]\" value=\"",
		date('d ',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y'])),'&nbsp;',
		$month[date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']))],'&nbsp;',
		date(' Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']))+543,"\">";

	}
		
	echo "</TABLE>";
	}else if($_GET["druginj"] == "Tetanus Toxoid"){

		echo "<TABLE width='300' cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
		<TR align='center'>
			<TD>วันที่นัดฉีด</TD>
		</TR>";

	$num[0] = 0;
	$num[1] = 1;
	$num[2] = 7;

	for($i=0;$i<3;$i++){
		
		echo "<TR><TD align='center'>";
		$get_time = mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']);
		$dcheck = date('d', $get_time);
		$mcheck = date('m', $get_time);
		$ycheck = date('Y', $get_time)+543;
		?>
		<select class="change-date" name="day[]">
			<?php foreach($days as $key => $day){ ?>
			<?php $checked = ( $dcheck==$key ) ? 'selected' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $checked;?>><?php echo $day;?></option>
			<?php } ?>
		</select>
		
		<select class="change-date" name="month[]">
			<?php foreach($month as $key => $m){ ?>
			<?php $checked = ( $mcheck==$key ) ? 'selected' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $checked;?>><?php echo $m;?></option>
			<?php } ?>
		</select>
		
		<select class="change-date" name="year[]">
			<?php foreach($years as $key => $y){ ?>
			<?php $checked = ( $ycheck==$y ) ? 'selected' : '' ;?>
			<option value="<?php echo $y;?>" <?php echo $checked;?>><?php echo $y;?></option>
			<?php } ?>
		</select>
		<?php
		echo "</TD></TR>";
		
		
		// echo "
		// <TR>
			// <TD align='center'>",
		// date('d ',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])),'&nbsp;',
		// $month[date('m',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))],'&nbsp;',
		// date(' Y',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))+543,"</TD>
		// </TR>";
		echo "
			<INPUT TYPE=\"hidden\" name=\"list_date[]\" value=\"".
			(date(' Y',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))+543)."-".
			(date('m',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])))."-".
			(date('d ',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])))."\">

			<INPUT TYPE=\"hidden\" name=\"list_date2[]\" value=\"",
		date('d ',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])),'&nbsp;',
		$month[date('m',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))],'&nbsp;',
		date(' Y',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))+543,"\">

			";
		

	}
		
	echo "</TABLE>";

	}else if($_GET["druginj"] == "Engerix-B" || $_GET["druginj"] == "Hepavax" ){

		echo "<TABLE width='300' cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
		<TR align='center'>
			<TD>วันที่นัดฉีด</TD>
		</TR>";

	$num[0] = 0;
	$num[1] = 1;
	$num[2] = 6;

	for($i=0;$i<3;$i++){
		
		echo "<TR><TD align='center'>";
		$get_time = mktime(0,0,0,$_GET['m'],$_GET['d']+$num[$i],$_GET['y']);
		$dcheck = date('d', $get_time);
		$mcheck = date('m', $get_time);
		$ycheck = date('Y', $get_time)+543;
		?>
		<select class="change-date" name="day[]">
			<?php foreach($days as $key => $day){ ?>
			<?php $checked = ( $dcheck==$key ) ? 'selected' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $checked;?>><?php echo $day;?></option>
			<?php } ?>
		</select>
		
		<select class="change-date" name="month[]">
			<?php foreach($month as $key => $m){ ?>
			<?php $checked = ( $mcheck==$key ) ? 'selected' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $checked;?>><?php echo $m;?></option>
			<?php } ?>
		</select>
		
		<select class="change-date" name="year[]">
			<?php foreach($years as $key => $y){ ?>
			<?php $checked = ( $ycheck==$y ) ? 'selected' : '' ;?>
			<option value="<?php echo $y;?>" <?php echo $checked;?>><?php echo $y;?></option>
			<?php } ?>
		</select>
		<?php
		echo "</TD></TR>";
		
		// echo "
		// <TR>
			// <TD align='center'>",
		// date('d ',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])),'&nbsp;',
		// $month[date('m',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))],'&nbsp;',
		// date(' Y',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))+543,"</TD>
		// </TR>";
		
		echo "
			<INPUT TYPE=\"hidden\" name=\"list_date[]\" value=\"".
			(date(' Y',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))+543)."-".
			(date('m',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])))."-".
			(date('d ',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])))."\">

			<INPUT TYPE=\"hidden\" name=\"list_date2[]\" value=\"",
		date('d ',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y'])),'&nbsp;',
		$month[date('m',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))],'&nbsp;',
		date(' Y',mktime(0,0,0,$_GET['m']+$num[$i],$_GET['d'],$_GET['y']))+543,"\">

			";
		

	}
		
	echo "</TABLE>";

	}

	exit();
}

$month[0] = "มกราคม";
$month[1] = "กุมภาพันธ์";
$month[2] = "มีนาคม";
$month[3] = "เมษายน";
$month[4] = "พฤษภาคม";
$month[5] = "มิถุนายน";
$month[6] = "กรกฏาคม";
$month[7] = "สิงหาคม";
$month[8] = "กันยายน";
$month[9] = "ตุลาคม";
$month[10] = "พฤศจิกายน";
$month[11] = "ธันวาคม";

?>

<HTML>
<HEAD>
<TITLE> นัดฉีดยา </TITLE>

<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
<SCRIPT LANGUAGE="JavaScript">
	
	window.onload = function(){
		
		view_inj();

	}

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

function viewdetail(action,hn) {
	var stat;
		if(document.getElementById("hn").value != ""){
			url = 'appoilst_inj.php?action='+action+'&hn=' + hn;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			stat = xmlhttp.responseText;
			stat = stat.substr(4);

			document.getElementById("div_viewdetail").innerHTML = stat;
		}
}

function view_inj(){
	
	d = document.getElementById("sdd").value;
	m= document.getElementById("smm").value;
	y = document.getElementById("syy").value;
	druginj = document.getElementById("drug_inj").value;

	url = 'appoilst_inj.php?action=view_inj&d='+d+'&m='+m+'&y='+y+'&druginj='+druginj;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);

	document.getElementById("detail_date").innerHTML = xmlhttp.responseText;

}

function checkForm(){

var stat = true;
	if(document.f1.hn.value == ''){
		alert('กรุณากรอก HN ด้วยครับ');
		stat = false;
	}else if(document.f1.drug_inj.value == ''){
		alert('กรุณาเลือกยา ด้วยครับ');
		stat = false;
	}else if(document.f1.doctor.value == ''){
		alert('กรุณาเลือก แพทย์ ด้วยครับ');
		stat = false;
	}else if(document.getElementById("div_viewdetail").innerHTML.length <= 139){
		alert('กรุณากดปุ่ม View เพื่อตรวจสอบชื่อ และ สิทธิ์ ผู้ป่วย');
		stat = false;
	}	


return stat;
}

</SCRIPT>
</HEAD>

<BODY onLoad="viewdetail('view',document.getElementById('hn').value);" >
<A HREF="../nindex.htm"><FONT SIZE="3" COLOR="#FF0000">&lt;&lt; เมนู</FONT></A><BR><BR>

<TABLE width="100%" border="0">
<TR valign="top">
	<TD  valign="top">
<FORM name="f1" METHOD=POST ACTION="print_appoilst_inj.php" Onsubmit="return checkForm();" target="_blank">
<TABLE align="center"  width="600" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE align="center" width='100%' border="0">
<TR>
	<TD align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">นัดฉีดยา</TD>
</TR>
<TR>
	<TD align="right">Hn : </TD><TD colspan="7"><!--$arr["hn"]-->
	<INPUT TYPE="text" ID="hn" NAME="hn" size="6" value="<?=$Thn?>">&nbsp;<INPUT TYPE="button" value="View" Onclick="viewdetail('view',document.getElementById('hn').value);">&nbsp;
	<span id="div_viewdetail"></span>
	</TD>
</TR>
<TR>
	<TD align="right">ว/ด/ป : </TD><TD colspan="7">
	
		<Select ID="sdd" name="sdd" Onchange="view_inj();">
		<?php for($i=1;$i<32;$i++){
			if($i<10) $j = "0";
				else $j = "";
			echo "<Option value=\"",$j,$i,"\" ";
					if($i == date("d")) echo " Selected ";
			echo ">",$i,"</Option>";	
		}?>
		</Select>
		&nbsp;:&nbsp;
		<Select ID="smm" name="smm" Onchange="view_inj();">
		<?php for($i=0;$i<12;$i++){
			if($i<10) $j = "0";
				else $j = "";
			echo "<Option value=\"",$j,($i+1),"\" ";
				if($i+1 == date("m")) echo " Selected ";			
			echo ">",$month[$i],"</Option>";	
		}?>
		</Select>
		&nbsp;:&nbsp;
		<Select ID="syy" name="syy" Onchange="view_inj();">
		<?php for($i=date("Y")-1;$i<date("Y")+3;$i++){
			echo "<Option value=\"",($i+543),"\" ";
				if($i == date("Y")) echo " Selected ";
			echo ">",($i+543),"</Option>";	
		}?>
		</Select>
		&nbsp;
		
	</TD>
</TR>
<TR>
	<TD align="right">ยา : </TD><TD colspan="7">
		<SELECT ID="drug_inj" NAME="drug_inj"  Onchange="view_inj();">
			<Option value="">-- เลือกยา --</Option>
			<Option value="Tetanus Toxoid">Tetanus Toxoid</Option>
			<Option value="VERORAB 2">VERORAB 2 เข็ม</Option>
			<Option value="VERORAB 3">VERORAB 3 เข็ม</Option>
			<Option value="VERORAB 5">VERORAB 5 เข็ม</Option>
			<Option value="Engerix-B">Engerix-B</Option>
			<Option value="Hepavax">Hepavax</Option>

		</SELECT>
	</TD>
</TR>
<TR>
	<TD align="right">แพทย์ : </TD><TD colspan="7">
		<select size="1" name="doctor" >
		<Option value="">-- เลือกแพทย์ --</Option>
<?php

	$sql = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
			if($arr["doctor"] == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?>

		</select>
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">วันนัด : </TD><TD>
	<div id="detail_date">
		
	</div>
	</TD>
</TR>
<TR>
	<TD colspan="2" align="center" ><INPUT TYPE="submit" value="ออกใบนัด"></TD>
</TR>
</TABLE>
</TD></TR></TABLE></TD></TR></TABLE>
</FORM>
<script type="text/javascript" src="js/vendor/jquery-1.11.2.min"></script>
<script type="text/javascript">
$(function(){
	
	$(document).on('change', '.change-date', function(){
		console.log($(this));
	});
	
});
</script>
</BODY>
</HTML>