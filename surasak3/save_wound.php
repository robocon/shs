
<?php
session_start();
if(isset($_GET["action"]) && ($_GET["action"] == "view" || $_GET["action"] == "view_inj" )){
	header("content-type: application/x-javascript; charset=TIS-620");
}
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

if(isset($_GET["action"]) && $_GET["action"] == "view"){
include("connect.inc");	
	$sql = "Select concat(yot,' ',name,' ',surname) as fullname, ptright, idcard, dbirth  From opcard where hn = '".$_GET["hn"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname, $ptright,$idcard,$dbirth) = Mysql_fetch_row($result);
	echo "<FONT COLOR=\"red\">����-ʡ�� ",$fullname,"&nbsp;&nbsp;�Է�ԡ���ѡ�� ", $ptright,"</FONT>";
	echo "<INPUT TYPE=\"hidden\" Name=\"fullname\" Value=\"".$fullname."\"><INPUT TYPE=\"hidden\" Name=\"ptright\" value=\"".$ptright."\"><INPUT TYPE=\"hidden\" Name=\"idcard\" value=\"".$idcard."\"><INPUT TYPE=\"hidden\" Name=\"dbirth\" value=\"".$dbirth."\"><INPUT TYPE=\"hidden\" Name=\"age\" value=\"".calcage($dbirth)."\">";
	
	 include("unconnect.inc");
	exit();
}


if(isset($_GET["action"]) && $_GET["action"] == "view_inj"){
$_GET['y'] = $_GET['y']-543;


	echo "<TABLE width='100%' cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
		<TR align='center'>
			<TD>�ѹ���Ѵ����</TD>
		</TR>";

	$num = 0;
	$count = $_GET["amount"];
	
	for($i=0;$i<$count;$i++){
		if($_GET["w"] != 0)
			$j=$i*$_GET["w"];
		else
			$j=$i;
		
		$date_appo = date('d',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y'])).' '.$month[date('m',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))].' '.(date('Y',mktime(0,0,0,$_GET['m'],$_GET['d']+$num+$j,$_GET['y']))+543);
			echo "<TR align='center'>";
			echo "<TD>";
			echo "�ѹ��� &nbsp;&nbsp;<INPUT TYPE=\"text\" id=\"calendar_date".$i."\" NAME=\"calendar_date".$i."\" value=\"".$date_appo."\" readonly>&nbsp;&nbsp;";
			echo "<input type=\"button\" name=\"calendar_button\" value=\".....\" onClick=\"document.f1.calendar_date".$i.".value='';showCalendar('calendar_date".$i."','DD-MM-YYYY')\">";
			
			
			
			
			
		echo "</TD>";
		echo "</TR>";
	}
		
	echo "</TABLE>";


	exit();
}

	
	



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

if(isset($_POST["B1"])){

include("connect.inc");

		$sql = "Select yot,  name,  surname From opcard where hn = '".$_POST["hn"]."'  limit 0,1 ";
		$result  = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);


		$n=$_POST['amount'];

 		for($i=0;$i<$n;$i++){
			
			$c=$n-1;
	$zz = explode(" ",$_POST["calendar_date".$i]);
	$datexx = explode(" ",$_POST["calendar_date".$c]);
	
	
	$date_2 = $zz[2]."-".date_month($zz[1])."-".$zz[0];
	$date_3 = $datexx[2]."-".date_month($datexx[1])."-".$datexx[0];
	
	
	$remark2=explode(" ",$_POST["remark2"]);
	$date_remark2 = $remark2[2]."-".date_month($remark2[1])."-".$remark2[0];
	
	
	$calendar_date = $_POST["calendar_date".$i];
 			
		
			//echo $date_2;
			//echo '<br>';
			//echo $date_3;
			
			$sql = "INSERT INTO `inhale_wound` ( `row_id` , `hn` , `date` , `yot` , `name` , `sname` , `startdate` , `enddate` , `idname` , `size_wound` , `total_day`, `detail`, `remark`, `remark2`,`detail2` ) 
			VALUES ('', '".$_POST["hn"]."', '".(date("Y")+543).date("-m-d H:i:s")."', '".$arr["yot"]."', '".$arr["name"]."', '".$arr["surname"]."', '".$date_2."', '".$date_3."', '".$_SESSION["sIdname"]."', '".$_POST["size_wound"]."', '".$_POST["amount"]."', '".$_POST["detail"]."', '".$_POST["remark"]."', '".$date_remark2."', '".$_POST["detail2"]."');
";
			
			///echo $sql."<br>";
	$result = Mysql_Query($sql);
		}

 //$date2=$_POST['sdd'][$i].'-'.$_POST['smm'][$i].'-'.$_POST['syy'][$i];
 //echo $date2;


$sql ="Select `hn`, date From `inhale_wound` where `hn` = '".$_POST["hn"]."' Order by `row_id` DESC limit 0,1 ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

echo "<A HREF=\"",$_SERVER['PHP_SELF'],"\">�͡㺹Ѵ�����¤�����</A>&nbsp;&nbsp;<A HREF=\"print_save_wound.php?date=$arr[date]&hn=",$arr["hn"],"\" target=\"_blank\">�����㺹Ѵ</A>";

//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=",$_SERVER['PHP_SELF'],"\">";
 include("unconnect.inc");
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
<script language="JavaScript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
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

			url = 'save_wound.php?action='+action+'&hn=' + hn;
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

	url = 'save_wound.php?action=view_inj&d='+d+'&m='+m+'&y='+y+'&amount='+amount+'&w='+w;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);

	document.getElementById("detail_date").innerHTML = xmlhttp.responseText;

}

function fncSubmit()
{
	if(document.f1.hn.value == "")
	{
		alert('��س��к� HN ���¤�Ѻ');
		document.f1.hn.focus();
		return false;
	}	
	if(document.f1.amount.value == "")
	{
		alert('��س��к� �ӹǹ�ѹ');
		document.f1.amount.focus();		
		return false;
	}	
	if(document.f1.detail.value == "")
	{
		alert('��س��к� �Ҵ�ź���ǳ');
		document.f1.detail.focus();		
		return false;
	}	
	document.f1.submit();
}

</script>

 �͡㺹Ѵ���� <A HREF="..\nindex.htm">&lt;&lt;����</A>
<FORM METHOD=POST ACTION="" name="f1" onSubmit="JavaScript:return fncSubmit();">
	<TABLE align="center">
	<TR>
	  <TD align="right">HN :</TD>
	  <TD><INPUT id="hn" TYPE="text" NAME="hn"  onblur="viewdetail('view',document.getElementById('hn').value);">
	    &nbsp;&nbsp;
	    <!--<INPUT TYPE="button" VALUE="��Ǩ�ͺ HN" Onclick="viewdetail('view',document.getElementById('hn').value);">--></TD>
	  </TR>
<TR>
	<TD colspan="7"  align="center"><span id="div_viewdetail"></span></TD>
</TR>
	<TR>
		<TD align="right">������Ѵ�ѹ��� :</TD>
		<TD><Select ID="sdd" name="sdd" >
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
		</Select></TD>
</TR>
	<TR>
	  <TD colspan="2"><br /><div id="detail_date"></div></TD>
	  </tr>
	</TR>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td></td>
	  </tr>
	<TR>
		<TD align="right">��Ҵ�� : </TD>
		<TD><SELECT NAME="size_wound">
			<OPTION VALUE="S" SELECTED>S</Option>
			<OPTION VALUE="M">M</Option>
			<OPTION VALUE="L">L</Option>
		</SELECT></TD>
	</TR>
	<TR>
		<TD align="right">�Ҵ�ź���ǳ : </TD>
		<TD><INPUT TYPE="text" NAME="detail" id="detail"></TD>
	</TR>
	<TR>
		<TD align="right">�����˵� : </TD>
		<TD><SELECT NAME="remark">
			<OPTION VALUE="" SELECTED></Option>
			<OPTION VALUE="�Ѵ����ѹ���" >�Ѵ����ѹ���<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></Option>
			<OPTION VALUE="Case Study ���">Case Study ���<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></Option>
			<OPTION VALUE="Case Study">Case Study + �Ѵ����ѹ���<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></Option>


		</SELECT>
		<INPUT TYPE="text" NAME="remark2"><input type="button" name="calendar_button" value="....." onClick="document.f1.remark2.value='';showCalendar('remark2','DD-MM-YYYY')">
		</TD>
	</TR>
	<TR>
	  <TD align="right">��������´</TD>
	  <TD><label for="textarea"></label>
      <textarea name="detail2" id="detail2" cols="45" rows="4"></textarea></TD>
	  </TR>
	<TR>
		<TD colspan="2" align="center"> 
       
        <INPUT TYPE="submit" value="��ŧ" name="B1">&nbsp;&nbsp;<INPUT TYPE="reset" value="¡��ԡ"> </TD>
	</TR>
	</TABLE>
</FORM>