<?php
session_start();
if(isset($_GET["action"]) && ($_GET["action"] == "view" || $_GET["action"] == "view_inj" )){
	header("content-type: application/x-javascript; charset=TIS-620");
}

 include("connect.inc");
// mysql_query("SET NAMES TIS620");
$month['01'] = "���Ҥ�";
$month['02'] = "����Ҿѹ��";
$month['03'] = "�չҤ�";
$month['04'] = "����¹";
$month['05'] = "����Ҥ�";
$month['06'] = "�Զع�¹";
$month['07'] = "�á�Ҥ�";
$month['08'] = "�ԧ�Ҥ�";
$month['09'] = "�ѹ��¹";
$month['10'] = "���Ҥ�";
$month['11'] = "��Ȩԡ�¹";
$month['12'] = "�ѹ�Ҥ�";

function date_month($val){
switch($val){
case "���Ҥ�": $i = "01"; break;
case "����Ҿѹ��": $i = "02"; break;
case "�չҤ�": $i = "03"; break;
case "����¹": $i = "04"; break;
case "����Ҥ�": $i = "05"; break;
case "�Զع�¹": $i = "06"; break;
case "�á�Ҥ�": $i = "07"; break;
case "�ԧ�Ҥ�": $i = "08"; break;
case "�ѹ��¹": $i = "09"; break;
case "���Ҥ�": $i = "10"; break;
case "��Ȩԡ�¹": $i = "11"; break;
case "�ѹ�Ҥ�": $i = "12"; break;
}
return $i;
}


Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

if(isset($_POST["add_app"]) && $_POST["add_app"] == "add"){
	
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("d/m/").(date("Y")+543); 

	for($i=0;$i<$_POST["amount"];$i++){

		$xx = explode("� ",$_POST["room"]);
		$xx[0] = $xx[0]."�";
		$zz = explode(" ",$_POST["calendar_date".$i]);

		$appdate_en = ($zz['2']-543).'-'.date_month($zz['1']).'-'.$zz['0'];

		$date_2 = $zz[2]."-".date_month($zz[1])."-".$zz[0];
		$calendar_date = $_POST["calendar_date".$i];
		$calendar_time = $_POST["calendar_time".$i];
		$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room, detail,detail2,advice,patho,xray,other,depcode,remark,appdate_en) VALUES('".$Thidate."','".$_SESSION["sOfficer"]."','".$_POST["hn"]."','".$_POST["fullname"]."','".$_POST["age"]."','".$_POST["doctor"]."','".$date_2."','".$calendar_time."', '".$xx[0]."','FU01 ��Ǩ����Ѵ','".$_POST["type"]."','NA','NA','NA','','U16  ��ͧ�ء�Թ','".$_POST["remark"]."','$appdate_en');";
		
		$insert = mysql_query($sql) or die(mysql_error());
		
	}



echo "<HTML>";
echo "<HEAD>
<style type=\"text/css\">
a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
	font-family:'Angsana New'; font-size:24px;
}

.font_title{
	font-family:'Angsana New'; font-size:24px;
	color:#FFFFFF;
	font-weight: bold;

}

.font_title_b{
	font-family:'Angsana New'; font-size:26px;
	font-weight: bold;

}

.font_title_n{
	font-family:'Angsana New'; font-size:22px;
}

</style>
	";
echo "</HEAD>";
echo "<BODY Onload=\"window.print();\">";
echo "<TABLE align='center'><TR><TD>";

echo "<CENTER><B><FONT  class='font_title_b'>㺹Ѵ�����©մ�ҵ�����ͧ �ç��Һ�Ť�������ѡ��������</FONT></B></CENTER>";
echo "&nbsp;&nbsp;<B>����</B> : ".$_POST["fullname"]."";
echo "&nbsp;&nbsp;<B>HN</B> : ".$_POST["hn"]." ";
echo "&nbsp;&nbsp;<B>����</B> : ".$_POST["age"]."";
echo "&nbsp;&nbsp;<B>�Է��</B> : ".$_POST["ptright"]."";

echo "<p><TABLE align='center' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD>&nbsp;&nbsp;&nbsp;<FONT  class='font_title_b'><B>����</B> : <U><B>".$_POST["type"]."</B></U></FONT>&nbsp;&nbsp;&nbsp;</TD>
</TR>
</TABLE></p>";

echo "<table><tr><td><table border='1' width='300' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>";
echo "<tr align='center'><td><B>�Ѵ�ѹ���</B></td><td><B>����</B></td><td><B>���մ</B></td></tr>";
for($i=0;$i<$_POST["amount"];$i++){
	
	$xx = explode("-",$_POST["list_date"][$i]);

	echo "<tr><td width='130' class='font_title_n'>".$_POST["calendar_date".$i]."</td>";
	echo "<td align='center'  width='70' class='font_title_n'>".substr($_POST["calendar_time".$i],0,-3)."</td>";
	echo "<td  width='100'>&nbsp;</td></tr>";
}
echo "</table></td><td>";

echo "<table>";
echo "<tr ><td align='right' class='font_title_n'><B>���㺹Ѵ���</B> : </td><td class='font_title_n'>".$_POST["room"]."</td></tr>";
echo "<tr><td align='right' class='font_title_n'><B>ᾷ����Ѵ</B> : </td><td class='font_title_n'>".substr($_POST["doctor"],5)."</td></tr>";
echo "<tr><td align='right' class='font_title_n'><B>����͡㺹Ѵ</B> : </td><td class='font_title_n'>".$_SESSION["sOfficer"]."</td></tr>";
echo "<tr><td align='center' class='font_title_n' colspan='2'>".$Thidate2." ".date("H:i")."</td></tr>";
echo "</table>";

echo "</td></table>";

echo "<CENTER><FONT class='font_title_b'><B>�����˵�</B> : <U><B>".$_POST["remark"]."</B></U></FONT></CENTER>";

echo "</TD></TR></TABLE>";
echo "</BODY>";
echo "</HTML>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=inject_wound_er.php\">";
exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "view"){
	
	$sql = "Select concat(yot,' ',name,' ',surname) as fullname, ptright, idcard, dbirth  From opcard where hn = '".$_GET["hn"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname, $ptright,$idcard,$dbirth) = Mysql_fetch_row($result);
	echo "<FONT COLOR=\"red\">",$fullname,"&nbsp;&nbsp;", $ptright,"</FONT>";
	echo "<INPUT TYPE=\"hidden\" Name=\"fullname\" Value=\"".$fullname."\"><INPUT TYPE=\"hidden\" Name=\"ptright\" value=\"".$ptright."\"><INPUT TYPE=\"hidden\" Name=\"idcard\" value=\"".$idcard."\"><INPUT TYPE=\"hidden\" Name=\"dbirth\" value=\"".$dbirth."\"><INPUT TYPE=\"hidden\" Name=\"age\" value=\"".calcage($dbirth)."\">";
	exit();
}
if(isset($_GET["action"]) && $_GET["action"] == "view_inj"){
$_GET['y'] = $_GET['y']-543;


	echo "<TABLE width='100%' cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
		<TR align='center'>
			<TD>�ѹ���Ѵ�մ</TD>
		</TR>";

	$num = 0;
	$count = $_GET["amount"];
	
	for($i=0;$i<$count;$i++){
		if($_GET["w"] != 0)
			$j=$i*$_GET["w"];
		else
			$j=$i;
		/*echo "
		<TR>
			<TD align='center'>",
		date('d ',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y'])),'&nbsp;',
		$month[date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))],'&nbsp;',
		date(' Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))+543,"&nbsp;���� : &nbsp16:00 �.
		<INPUT TYPE=\"hidden\" name=\"capptime[]\" value=\"16:00 �.\">

		</TD>
		</TR>";*/
		
		$date_appo = date('d',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y'])).' '.$month[date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))].' '.
		(date('Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))+543);
		echo "<TR>";
			echo "<TD>";
			echo "�ѹ��� &nbsp;&nbsp; <INPUT TYPE=\"text\" NAME=\"calendar_date".$i."\" value=\"".$date_appo."\" readonly>&nbsp;&nbsp;";
			echo "<input type=\"button\" name=\"calendar_button\" value=\".....\" onClick=\"document.f1.calendar_date".$i.".value='';showCalendar('calendar_date".$i."','DD-MM-YYYY')\">";

			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� : ";
			echo "<select size=\"1\" name=\"calendar_time".$i."\">
			<option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
			<option value=\"07:00:00\">07:00 &#3609;.</option>
			<option value=\"07:30:00\">07:30 &#3609;.</option>
			<option value=\"08:00:00\">08:00 &#3609;.</option>
			<option value=\"08:30:00\">08:30 &#3609;.</option>
			<option value=\"09:00:00\">09:00 &#3609;.</option>
			<option value=\"09:30:00\">09:30 &#3609;.</option>
			<option value=\"10:00:00\">10:00 &#3609;.</option>
			<option value=\"10:30:00\">10:30 &#3609;.</option>
			<option value=\"11:00:00\">11:00 &#3609;.</option>
			<option value=\"11:30:00\">11:30 &#3609;.</option>
			<option value=\"13:00:00\">13:00 &#3609;.</option>
			<option value=\"13:30:00\">13:30 &#3609;.</option>
			<option value=\"14:00:00\">14:00 &#3609;.</option>
			<option value=\"14:30:00\">14:30 &#3609;.</option>
			<option value=\"15:00:00\">15:00 &#3609;.</option>
			<option value=\"15:30:00\">15:30 &#3609;.</option>
			<option value=\"16:00:00\" selected>16:00 &#3609;.</option>
			<option value=\"16:30:00\" >16:30 &#3609;.</option>
			<option value=\"17:00:00\">17:00 &#3609;.</option>
			<option value=\"17:30:00\">17:30 &#3609;.</option>
			<option value=\"18:00:00\">18:00 &#3609;.</option>
			<option value=\"18:30:00\">18:30 &#3609;.</option>
			<option value=\"19:00:00\">19:00 &#3609;.</option>
			<option value=\"19:30:00\">19:30 &#3609;.</option>
			<option value=\"20:00:00\">20:00 &#3609;.</option>
			<option value=\"21:00:00\">21:00 &#3609;.</option></select>";
			echo "</TD>";
		echo "</TR>";

		//echo "<INPUT TYPE=\"hidden\" name=\"list_date[]\" value=\"".(date(' Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))+543)."-".(date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y'])))."-".(date('d ',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y'])))."\">";

		

	}
		
	echo "</TABLE>";


	exit();
}

$month[0] = "���Ҥ�";
$month[1] = "����Ҿѹ��";
$month[2] = "�չҤ�";
$month[3] = "����¹";
$month[4] = "����Ҥ�";
$month[5] = "�Զع�¹";
$month[6] = "�á�Ҥ�";
$month[7] = "�ԧ�Ҥ�";
$month[8] = "�ѹ��¹";
$month[9] = "���Ҥ�";
$month[10] = "��Ȩԡ�¹";
$month[11] = "�ѹ�Ҥ�";

?>
<HTML>
<HEAD>
<TITLE> �Ѵ�մ�� </TITLE>

<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:'Angsana New'; font-size:24px;
}

.font_title{
	font-family:'Angsana New'; font-size:24px;
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

function viewdetail(action,hn) {
	var stat;
	
		if(document.getElementById("hn").value != ""){

			url = 'inject_wound_er.php?action='+action+'&hn=' + hn;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			stat = xmlhttp.responseText;
			stat = stat.substr(4);

			document.getElementById("div_viewdetail").innerHTML = stat;
		}
}

function view_inj(w){

	d = document.getElementById("sdd").value;
	m= document.getElementById("smm").value;
	y = document.getElementById("syy").value;
	amount = document.getElementById("amount").value;

	url = 'inject_wound_er.php?action=view_inj&d='+d+'&m='+m+'&y='+y+'&amount='+amount+'&w='+w;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);

	document.getElementById("detail_date").innerHTML = xmlhttp.responseText;

}

function checkForm(){
var txt = "";
var stat = true;
var ff = document.f1;
	if(ff.hn.value == ''){
		txt = txt+"��سҡ�͡ hn \n"; stat = false;
	}
	
	if(document.getElementById('div_viewdetail').innerHTML == ''){
		txt = txt+"��سҡ�������Ǩ�ͺ hn \n"; stat = false;
	}
	
	if(ff.type.value == ''){
		txt = txt+"��س����͡ �Ѵ���� \n"; stat = false;
	}
	
	if(ff.room.value == ''){
		txt = txt+"��س����͡ �׹㺹Ѵ��� \n"; stat = false;
	}
	
	if(ff.doctor.value == '��س����͡ᾷ��'){
		txt = txt+"��س����͡ ᾷ�� \n"; stat = false;
	}

if(stat == false){
	alert(txt);
}
return stat;
}


</SCRIPT>
<a target=_top  href="../nindex.htm">&lt;&lt; ����</a>
<script language="JavaScript" src="calendar/calendar.js">
</script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<FORM Name="f1" METHOD=POST ACTION="" Onsubmit="return checkForm();">
<TABLE align="center" border="0">
<TR>
	<TD colspan="7"  align="center"><B>�͡㺹Ѵ�մ�ҵ�����ͧ</B></TD>
</TR>
<TR>
	<TD align="right">HN : </TD>
	<TD colspan="6"><INPUT id="hn" TYPE="text" NAME="hn" >&nbsp;&nbsp;<INPUT TYPE="button" VALUE="��Ǩ�ͺ HN" Onclick="viewdetail('view',document.getElementById('hn').value);"></TD>
</TR>
<TR>
	<TD colspan="7"  align="center"><span id="div_viewdetail"></span></TD>
</TR>
<TR>
	<TD align="right">�Ѵ���ѹ��� : </TD>
	<TD colspan="6">
	<Select ID="sdd" name="sdd" >
		<?php for($i=1;$i<32;$i++){
			if($i<10) $j = "0";
				else $j = "";
			echo "<Option value=\"",$j,$i,"\" ";
					if($i == date("d")) echo " Selected ";
			echo ">",$i,"</Option>";	
		}?>
		</Select>
		&nbsp;:&nbsp;
		<Select ID="smm" name="smm" >
		<?php for($i=0;$i<12;$i++){
			if($i<10) $j = "0";
				else $j = "";
			echo "<Option value=\"",$j,($i+1),"\" ";
				if($i+1 == date("m")) echo " Selected ";			
			echo ">",$month[$i],"</Option>";	
		}?>
		</Select>
		&nbsp;:&nbsp;
		<Select ID="syy" name="syy" >
		<?php for($i=date("Y")-1;$i<date("Y")+3;$i++){
			echo "<Option value=\"",($i+543),"\" ";
				if($i == date("Y")) echo " Selected ";
			echo ">",($i+543),"</Option>";	
		}?>
		</Select>
	&nbsp;�ӹǹ�ѹ: <Select ID="amount" name="amount" Onchange="view_inj(0);">
		<?php 
		echo "<Option value=\"\" >---</Option>";	
		for($i=1;$i<8;$i++){
			echo "<Option value=\"",$i,"\" ";
			echo ">",$i,"</Option>";	
		}?>
		</Select>&nbsp;&nbsp;���˹���ҷԵ�� : <INPUT TYPE="checkbox" NAME="between" Onclick="if(this.checked==true) view_inj(7); else view_inj(0);"></TD>
</TR>

<TR>
	<TD colspan="7">
		<div id="detail_date"></div>	</TD>
</TR>
<TR>
	<TD align="right">���� : </TD>
	<TD colspan="6">
		<INPUT TYPE="text" NAME="type" size="40">
		<SELECT NAME="type2" onChange="document.f1.type.value = this.value;">
			<Option value="">-- ���� --</Option>
			<!-- <Option value="cef-3 1 gm. V dilule       a push">cef-3 1 gm. V dilule        a push</Option> -->
			<Option value="cef-3 1 gm. V  push">cef-3 1 gm. V  push</Option>
			<Option value="cef-3 2 gm. V drip in 0.9% nss 100 cc.">cef-3 2 gm. V drip in 0.9% nss 100 cc.</Option>
		</SELECT>		</TD>
</TR>
<TR>
	<TD align="right">�׹㺹Ѵ��� : </TD>
	<TD colspan="6">
		<SELECT NAME="room" >
			<Option value="">-- �׹㺹Ѵ��� --</Option>
			<Option value="����¹ ���� �͡ vn">����¹ ���� �͡ vn</Option>
			<Option value="����¹ ���� �͡ OPD Card(�����������)">����¹ ���� �͡ OPD Card(�����������)</Option>
			<Option value="��ͧ�ء�Թ ">��ͧ�ء�Թ</Option>
		</SELECT>	</TD>
</TR>
<TR>
	<TD align="right">ᾷ�� : </TD>
	<TD>
		<select name="doctor">
		<?php
			$sql = "Select name From doctor Order by name ASC";
			$result = mysql_query($sql);
			while(list($doctor_name) = mysql_fetch_row($result)){
				echo "<option value=\"".trim($doctor_name)."\">".$doctor_name."</option>";
			}
		?>
		
    </select>	</TD>
</TR>
<TD align="right">�����˵� : </TD> 
	<TD colspan="6"><select name="remark">
		<option value="">--�����˵�--</option>
		<option value="�Դ��Һ�ԡ�� E-IV ����ѹ">�Դ��Һ�ԡ�� E-IV ����ѹ</option>
		<option value="�Դ��Һ�ԡ�� E-SC ����ѹ">�Դ��Һ�ԡ�� E-SC ����ѹ</option>
		<option value="�Դ��Һ�ԡ�� EIM ����ѹ">�Դ��Һ�ԡ�� EIM ����ѹ</option>
		<option value="�Դ��Һ�ԡ������੾���ѹ�á">�Դ��Һ�ԡ������੾���ѹ�á</option>
    </select></TD>
</TR>
	<TR>
	<TD colspan="7"  align="center"><INPUT TYPE="submit" value="��ŧ"></TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" name="add_app" value="add">
</FORM>
</BODY>
</HTML>
<?php include("unconnect.inc"); ?>