<?php

if(isset($_GET["action"]) && $_GET["action"] == "list_inf"){
	header("content-type: application/x-javascript; charset=TIS-620");

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

	for($k=1;$k<=$_GET["total"];$k++){
		
		$time = mktime(0,0,0,date("m"),date("d")+(7*$k),date("Y"));

		$date_appo = date("d",$time)." ".$month[date("m",$time)]." ".(date("Y",$time)+543);

		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "&nbsp;������ :";
		echo "<INPUT TYPE=\"text\" NAME=\"number_inject".$k."\" value=\"".($k+1)."\" size=\"2\">";
		echo " �Ѵ�ѹ��� ";
		echo "<INPUT TYPE=\"text\" NAME=\"calendar_date".$k."\" value=\"".$date_appo."\" readonly>&nbsp;&nbsp;";
		echo "<input type=\"button\" name=\"calendar_button\" value=\".....\" onClick=\"document.f1.calendar_date".$k.".value='';showCalendar('calendar_date".$k."','DD-MM-YYYY')\">";
		echo " ���� ";
		echo "<select size=\"1\" name=\"capptime".$k."\"><option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option><option>07:00 &#3609;.</option><option>07:30 &#3609;.</option><option>08:00 &#3609;.</option><option>08:30 &#3609;.</option><option selected>09:00 &#3609;.</option><option>09:30 &#3609;.</option><option>10:00 &#3609;.</option><option>10:30 &#3609;.</option><option>11:00 &#3609;.</option><option>11:30 &#3609;.</option><option>13:00 &#3609;.</option><option>13:30 &#3609;.</option><option>14:00 &#3609;.</option><option>14:30 &#3609;.</option><option>15:00 &#3609;.</option><option>15:30 &#3609;.</option><option>16:00 &#3609;.</option><option>16:30 &#3609;.</option><option>17:00 &#3609;.</option><option>17:30 &#3609;.</option><option>18:00 &#3609;.</option><option>18:30 &#3609;.</option><option>19:00 &#3609;.</option><option>19:30 &#3609;.</option><option>20:00 &#3609;.</option><option>21:00 &#3609;.</option></select>";
		echo " &nbsp;&nbsp; <INPUT TYPE=\"text\" NAME=\"detail".$k."\" value=\"�ѧ�����Դ��Һ�ԡ��\"><BR>";

	 }

exit();
}

include("connect.inc");
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

function view_inj(type_inj){
	var total = 5;

	if(type_inj == 'Synvisc'){
		total = 2;
	}else if(type_inj == 'Go-on'){
		total = 4;
	}else if(type_inj == 'Hyruan'){
		total = 4;
	}

	url = 'inject_wound.php?action=list_inf&total='+total;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);

	document.getElementById("detail_date").innerHTML = xmlhttp.responseText;

}

function checkForm(){
	var nform = document.f1;
	var stat = true;
	if(nform.hn.value ==""){
		alert("��سҡ�͡ HN ���¤�Ѻ");
		stat = false;
	}else if(nform.type.value ==""){
		alert("��س����͡ �մ�� ���¤�Ѻ");
		stat = false;
	}else if(nform.doctor.value ==""){
		alert("��س����͡ ᾷ�� ���¤�Ѻ");
		stat = false;
	}

	return stat;

}

</SCRIPT>
<a target=_top  href="../nindex.htm">&lt;&lt; ����</a>
<script language="JavaScript" src="calendar/calendar.js">
</script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<FORM Name="f1" METHOD=POST ACTION="print_inject_wound.php" Onsubmit="return checkForm();">
<TABLE align="center" border="0">
<TR>
	<TD colspan="7"  align="center">�͡㺹Ѵ�մ�����ͧ�ء�Թ</TD>
</TR>
<TR>
	<TD align="right">HN : </TD>
	<TD colspan="6"><INPUT id="hn" TYPE="text" NAME="hn" >&nbsp;&nbsp;<INPUT TYPE="button" VALUE="��Ǩ�ͺ HN" ONCLICK="window.open('pop_save_wound.php?hn='+document.getElementById('hn').value ,'_target','width=400,height=200,x=0,y=0');"></TD>
</TR>
<TR>
	<TD align="right">�մ�� : </TD>
	<TD colspan="6">
		<SELECT NAME="type" onchange="view_inj(this.value);">
			<Option value="">-- �մ�� --</Option>
			<Option value="Synvisc">Synvisc</Option>
			<Option value="Go-on">Go-on</Option>
			<Option value="Hyruan">Hyruan</Option>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD colspan="7">
		<div id="detail_date"></div>
	</TD>
</TR>

<TR>
	<TD align="right">��� : </TD>
	<TD>
		<SELECT NAME="knee">
			<Option value="RT">RT</Option>
			<Option value="LT">LT</Option>
		</SELECT>
	</TD>
	<TD align="right">ᾷ�� : </TD>
	<TD  colspan="4">
		<select name="doctor">
		<?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		$sql = "Select name From doctor where status = 'y' AND name <> ' ��س����͡ᾷ��'";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select>
	</TD>
</TR>
<TD align="right">�����˵� : </TD> 
	<TD colspan="6"><INPUT TYPE="text" NAME="remark" value="�ҡ�������������ö����ѹ���Ҵѧ�������  �ô�Դ�����ͧ�ء�Թ �� 054-839305-6 ��� 1111, 1112" size="50"></TD>
</TR>
	<TR>
	<TD colspan="7"  align="center"><INPUT TYPE="submit" value="��ŧ"></TD>
</TR>
</TABLE>
</FORM>
<?php
include("unconnect.inc");
?>