
<?php
session_start();
if(isset($_GET["action"]) && ($_GET["action"] == "view" || $_GET["action"] == "view_inj" )){
	header("content-type: application/x-javascript; charset=TIS-620");
}
$month['01'] = "มกราคม";
$month['02'] = "กุมภาพันธ์";
$month['03'] = "มีนาคม";
$month['04'] = "เมษายน";
$month['05'] = "พฤษภาคม";
$month['06'] = "มิถุนายน";
$month['07'] = "กรกฎาคม";
$month['08'] = "สิงหาคม";
$month['09'] = "กันยายน";
$month['10'] = "ตุลาคม";
$month['11'] = "พฤศจิกายน";
$month['12'] = "ธันวาคม";

if(isset($_GET["action"]) && $_GET["action"] == "view"){
include("connect.inc");	
	$sql = "Select concat(yot,' ',name,' ',surname) as fullname, ptright, idcard, dbirth  From opcard where hn = '".$_GET["hn"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname, $ptright,$idcard,$dbirth) = Mysql_fetch_row($result);
	echo "<FONT COLOR=\"red\">ชื่อ-สกุล ",$fullname,"&nbsp;&nbsp;สิทธิการรักษา ", $ptright,"</FONT>";
	echo "<INPUT TYPE=\"hidden\" Name=\"fullname\" Value=\"".$fullname."\"><INPUT TYPE=\"hidden\" Name=\"ptright\" value=\"".$ptright."\"><INPUT TYPE=\"hidden\" Name=\"idcard\" value=\"".$idcard."\"><INPUT TYPE=\"hidden\" Name=\"dbirth\" value=\"".$dbirth."\"><INPUT TYPE=\"hidden\" Name=\"age\" value=\"".calcage($dbirth)."\">";
	
	 include("unconnect.inc");
	exit();
}


if(isset($_GET["action"]) && $_GET["action"] == "view_inj"){
$_GET['y'] = $_GET['y']-543;


	echo "<TABLE width='100%' cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
		<TR align='center'>
			<TD>วันที่นัดทำแผล</TD>
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
			echo "วันที่ &nbsp;&nbsp;<INPUT TYPE=\"text\" id=\"calendar_date".$i."\" NAME=\"calendar_date".$i."\" value=\"".$date_appo."\" readonly>&nbsp;&nbsp;";
			echo "<input type=\"button\" name=\"calendar_button\" value=\".....\" onClick=\"document.f1.calendar_date".$i.".value='';showCalendar('calendar_date".$i."','DD-MM-YYYY')\">";
			
			
			
			
			
		echo "</TD>";
		echo "</TR>";
	}
		
	echo "</TABLE>";


	exit();
}

	
	



function date_month($val){
switch($val){
case "มกราคม": $i = "01"; break;
case "กุมภาพันธ์": $i = "02"; break;
case "มีนาคม": $i = "03"; break;
case "เมษายน": $i = "04"; break;
case "พฤษภาคม": $i = "05"; break;
case "มิถุนายน": $i = "06"; break;
case "กรกฎาคม": $i = "07"; break;
case "สิงหาคม": $i = "08"; break;
case "กันยายน": $i = "09"; break;
case "ตุลาคม": $i = "10"; break;
case "พฤศจิกายน": $i = "11"; break;
case "ธันวาคม": $i = "12"; break;
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

echo "<A HREF=\"",$_SERVER['PHP_SELF'],"\">ออกใบนัดผู้ป่วยคนใหม่</A>&nbsp;&nbsp;<A HREF=\"print_save_wound.php?date=$arr[date]&hn=",$arr["hn"],"\" target=\"_blank\">พิมพ์ใบนัด</A>";

//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=",$_SERVER['PHP_SELF'],"\">";
 include("unconnect.inc");
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
		alert('กรุณาระบุ HN ด้วยครับ');
		document.f1.hn.focus();
		return false;
	}	
	if(document.f1.amount.value == "")
	{
		alert('กรุณาระบุ จำนวนวัน');
		document.f1.amount.focus();		
		return false;
	}	
	if(document.f1.detail.value == "")
	{
		alert('กรุณาระบุ บาดแผลบริเวณ');
		document.f1.detail.focus();		
		return false;
	}	
	document.f1.submit();
}

</script>

 ออกใบนัดทำแผล <A HREF="..\nindex.htm">&lt;&lt;เมนู</A>
<FORM METHOD=POST ACTION="" name="f1" onSubmit="JavaScript:return fncSubmit();">
	<TABLE align="center">
	<TR>
	  <TD align="right">HN :</TD>
	  <TD><INPUT id="hn" TYPE="text" NAME="hn"  onblur="viewdetail('view',document.getElementById('hn').value);">
	    &nbsp;&nbsp;
	    <!--<INPUT TYPE="button" VALUE="ตรวจสอบ HN" Onclick="viewdetail('view',document.getElementById('hn').value);">--></TD>
	  </TR>
<TR>
	<TD colspan="7"  align="center"><span id="div_viewdetail"></span></TD>
</TR>
	<TR>
		<TD align="right">เริ่มนัดวันที่ :</TD>
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
	&nbsp;จำนวนวัน: <Select ID="amount" name="amount" Onchange="view_inj(0);">
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
		<TD align="right">ขนาดแผล : </TD>
		<TD><SELECT NAME="size_wound">
			<OPTION VALUE="S" SELECTED>S</Option>
			<OPTION VALUE="M">M</Option>
			<OPTION VALUE="L">L</Option>
		</SELECT></TD>
	</TR>
	<TR>
		<TD align="right">บาดแผลบริเวณ : </TD>
		<TD><INPUT TYPE="text" NAME="detail" id="detail"></TD>
	</TR>
	<TR>
		<TD align="right">หมายเหตุ : </TD>
		<TD><SELECT NAME="remark">
			<OPTION VALUE="" SELECTED></Option>
			<OPTION VALUE="ตัดไหมวันที่" >ตัดไหมวันที่<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></Option>
			<OPTION VALUE="Case Study ที่">Case Study ที่<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></Option>
			<OPTION VALUE="Case Study">Case Study + ตัดไหมวันที่<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U></Option>


		</SELECT>
		<INPUT TYPE="text" NAME="remark2"><input type="button" name="calendar_button" value="....." onClick="document.f1.remark2.value='';showCalendar('remark2','DD-MM-YYYY')">
		</TD>
	</TR>
	<TR>
	  <TD align="right">รายละเอียด</TD>
	  <TD><label for="textarea"></label>
      <textarea name="detail2" id="detail2" cols="45" rows="4"></textarea></TD>
	  </TR>
	<TR>
		<TD colspan="2" align="center"> 
       
        <INPUT TYPE="submit" value="ตกลง" name="B1">&nbsp;&nbsp;<INPUT TYPE="reset" value="ยกเลิก"> </TD>
	</TR>
	</TABLE>
</FORM>