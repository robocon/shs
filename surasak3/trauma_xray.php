<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");



function jschars($str)
{
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

//************************** แสดงรายการยาให้เลือก  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "xray"){

	$sql = "Select code, detail From xraycare where  detail like '%".$_GET["search"]."%' AND part = 'xray' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:720px; height:430px; overflow:auto; \">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"20\"><font style=\"color: #FFFFFF\"></font></td>
			<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>รายละเอียด</strong></font></td>
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
					<td >
					<INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)addtolist('".$arr["code"]."'); \" ondblclick=\"addtolist('".$arr["code"]."'); \">    </td>
					<td bgcolor=\"$bgcolor\">",$arr["detail"],"</td>
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

//************************** แสดงรายการ xray  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){

$count = count($_SESSION["list_code"]);

	echo "<B>รายการ xray : </B>
	<TABLE align=\"center\" ID=\"main_tb\" width=\"98%\" border=\"1\" bordercolor=\"#000000\" cellpadding=\"3\" cellspacing=\"0\" style='BORDER-COLLAPSE: collapse'>
		<TR class=\"tb_head\" >
			<TD rowspan=\"1\" width=\"20\"><INPUT TYPE=\"checkbox\" NAME=\"\"></TD>
			<TD rowspan=\"1\" align=\"center\">รายการ</TD>
		</TR>
		";

for($i=0;$i<$count;$i++){
	
	if($i%2==0)
		$color= "#FFFFCC";
	else
		$color= "#FFFFFF";

		echo "<TR bgcolor=\"".$color."\">
			<TD width=\"20\" align=\"center\">
				<INPUT TYPE=\"checkbox\" NAME=\"code[]\" value=\"".$_SESSION["list_code"][$i]."\">
				<TD align=\"center\">".$_SESSION["list_code"][$i]."</TD>
			</TD>
		</TR>";
}
	if($count > 0){


echo "<TR align=\"center\">
	<TD width=\"20\"><INPUT TYPE=\"button\" value=\" ลบ \" onclick=\"mutidel_list();\"></TD>
	<TD colspan=\"3\"><INPUT TYPE=\"submit\" value=\"ตกลง\"></TD>
</TR>";

	}
	/*echo "</TABLE>

	<TABLE ID=\"main_tb2\" style=\"display:none\" width=\"98%\" cellpadding=\"3\" cellspacing=\"0\" ID=\"main_tb2\" style=\"\">
	<TR  class=\"tb_head\">
		<TD colspan=\"2\" align=\"center\">รายละเอียดเพิ่มเติม</TD>
	</TR>
	<TR>
		<TD align=\"right\" valign=\"top\">ประเภทการตรวจ</TD>
		<TD>
		<INPUT TYPE=\"radio\" NAME=\"type_diag\" value=\"ตรวจวิเคราะห์เพื่อการรักษา\" checked> ตรวจวิเคราะห์เพื่อการรักษา<BR>
		<INPUT TYPE=\"radio\" NAME=\"type_diag\" value=\"ตรวจสุขภาพ\"> ตรวจสุขภาพ<BR>
		<INPUT TYPE=\"radio\" NAME=\"type_diag\" value=\"ประกันสังคมกรณีคลอดบุตร\"> ประกันสังคมกรณีคลอดบุตร
	</TD>
	</TR>
	<TR>
		<TD align=\"right\" valign=\"top\">รายละเอียดอื่นๆเพิ่มเติ่ม</TD>
		<TD><TEXTAREA NAME=\"detailbydr\" ROWS=\"6\" COLS=\"40\"></TEXTAREA></TD>
	</TR>
	<TR>
		<TD colspan=\"2\" align=\"center\"><INPUT TYPE=\"submit\" value=\"ตกลง\"></TD>
	</TR>
</TABLE>

";*/
	exit();

}


//************************** แสดงรายการ xray  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){
	$sql = "Select detail, yprice, nprice From xraycare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	//array_push($_SESSION["list_detail"],$detail);
	//array_push($_SESSION["list_nprice"],$nprice);
	//array_push($_SESSION["list_yprice"],$yprice);

	exit();
}

//************************** ลบข้อมูลออกจากรายการ  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	for($i=0;$i<$count;$i++){
		
		if($_GET["code"] == $_SESSION["list_code"][$i]){
			$j=$i;
			break;
		}

	}

	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];
		$_SESSION["list_nprice"][$i] = $_SESSION["list_nprice"][$i+1];
		$_SESSION["list_yprice"][$i] = $_SESSION["list_yprice"][$i+1];
	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);
	unset($_SESSION["list_nprice"][$count-1]);
	unset($_SESSION["list_yprice"][$count-1]);

	exit();
}

$_SESSION["list_code"] = array() ;
		$_SESSION["list_detail"] = array() ;

		session_register("list_nprice");
		session_register("list_yprice");

		$_SESSION["list_nprice"] = array() ;
		$_SESSION["list_yprice"] = array() ;
		
//runno  for chktranx
session_unregister("nRunno");
session_register("nRunno");

    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart' limit 1";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query) or die("Query failed");
//end  runno  for chktranx
?>
<html>
<head>
<title>สั่ง xray ผู้ป่วยนอก</title>
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

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'trauma_xray.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			
		}
}

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'trauma_xray.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();

}

function addbycheck(code){


		addtolist(code);


}

function addsuittolist(suil){
	
	var code = suil.split('][');
	if(code.length > 0){
		for(i=0;i<code.length;i++)
			addtolist(code[i]);
	}

}



function viewlist(){
	
	url = 'trauma_xray.php?action=viewtolist';

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("viewlist").innerHTML = xmlhttp.responseText;

}

function del_list(code){

	url = 'trauma_xray.php?action=delete&code=' + code;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

}

function mutidel_list(){

	for(i=0;i<eval(document.form_list.elements.length);i++){
		if(document.form_list.elements[i].name == "code[]" && document.form_list.elements[i].checked == true){
			del_list(document.form_list.elements[i].value);
			if(document.getElementById(document.form_list.elements[i].value))
				document.getElementById(document.form_list.elements[i].value).checked = false;
			
		}

	}
	viewlist();
}

function checkall(formname,checkname,statuscheck){
	
	for(i=0;i<eval(formname.elements.length);i++){

			if(formname.elements[i].name == checkname ){
				formname.elements[i].checked = statuscheck;
			}
		}

}


</SCRIPT>
</head>
<body>

<?php


$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatevn=$d.'-'.$m.'-'.$yr.$_GET["vn"];

	$sql = "SELECT count(row_id) FROM opday WHERE thdatevn = '$thdatevn' limit 1";
    $result = mysql_query($sql);
	list($rows) = Mysql_fetch_row($result);

	if($rows <=0){
			
			echo "<BR><BR><CENTER><FONT SIZE=\"4\" COLOR=\"#FF0000\">ไม่มีหมายเลข VN : ".$_GET["vn"]." </FONT></CENTER>";

	exit();
	}


	
	$r=2;
	$count = count($list_xray_check);

?>
<TABLE align="center" width="950" border="0">
<TR valign="top">
	<TD width="550">

<TABLE width="100%" border="1" bordercolor="#3366FF">
<TR>
	<TD  align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">
		รายการ xray
	</TD>
</TR>
<TR>
	<TD>
		Other : <INPUT id="idother" TYPE="text" NAME="" size="10"> <INPUT TYPE="button" value="Add" Onclick="addbycheck(document.getElementById('idother').value);">
	</TD>
</TR>
<TR>
	<TD>
<?php
$sql = "Select concat(xraycode,' ',xraysub) as xraydetail From xraylist where xraytype = '0' OR xraytype = '4' ";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);
?>
<TABLE  border="0" width="100%">
<TR >
<?php
$i=1;
	while($arr = mysql_fetch_assoc($result)){
		$bgcolor = "#95FF95";
		$detail = str_replace("'","\'",$arr["xraydetail"]);
		echo "<TD   style=\"font-family:'Angsana New'; font-size:22px;\" bgcolor=\"".$bgcolor."\"><A HREF=\"javascript:void(0);\" Onclick=\"addbycheck('".$detail."');\" style=\"text-decoration:none; color:#000099;\">".$arr["xraydetail"]."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
		$i++;
	}
?>
</TR>
</TABLE>
<TABLE  border="0" width="100%"  cellpadding="4" cellspacing="0">

<?php
$i=1;
	$sql = "Select xraycode , xraysub From xraylist  where xraytype = '3' OR xraytype = '1' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
		echo "<TR>";
		
	while($arr = mysql_fetch_assoc($result)){


			$bgcolor = "#95FF95";

		echo "<TD>";
		echo "<TABLE width=\"100%\" bgcolor=\"".$bgcolor."\"><TR><TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">".$arr["xraycode"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"addbycheck('".$arr["xraycode"]." RT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">RT. ".$arr["xraysub"]."</A></TD>";
		echo "</TR>";
		echo "<TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"addbycheck('".$arr["xraycode"]." LT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">LT. ".$arr["xraysub"]."</A></TD></TABLE>";

		echo "</TD>";
		
		if($i % 2 == 0)
			echo "</TR><TR  >";
		

		$i++;
	}
?>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>

</TD>
	<TD valign="top" align="center">
<TABLE width="100%" border="1" bordercolor="#3366FF">
<TR>
	<TD  align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">
		สั่ง xray ผู้ป่วยนอก
	</TD>
</TR>
<TR>
	<TD>

<SCRIPT LANGUAGE="JavaScript">

	function checkFrom(){
		
		if(document.form_list.doctor.value== ""){
			alert("กรุณาเลือกชื่อ แพทย์ ด้วยครับ");
			return false;
		}else{
			return truel
		}

	}

</SCRIPT>


<FORM  NAME="form_list" METHOD=POST ACTION="trauma_xray_add.php" Onsubmit="return checkFrom();">
<?php
	$sql = "Select ptname, ptright, vn, hn, an From opday where vn='".$_GET["vn"]."' Order by row_id DESC limit 1 ";
	$result = Mysql_Query($sql) or die(Mysql_error());
	$arr = Mysql_fetch_assoc($result);

	$sql = "Select yot, name, surname, dbirth From opcard where hn='".$arr["hn"]."' limit 0,1";
	$result = Mysql_Query($sql) or die(Mysql_error());
	list($yot,$pname,$surname, $dbirth)=mysql_fetch_row($result);


	echo "<B>ชื่อผู้ป่วย : </B>",$arr["ptname"]," <BR><B>สิทธิ์การรักษา : </B>",$arr["ptright"]
?><BR>
<B>แพทย์ : </B>
<SELECT NAME="doctor">
	<option value="" selected>-- เลือกแพทย์ --</option>
<?php

	$sql = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\">".$name."</option>";
	}
?>
</SELECT>
<BR>
<B>ประเภทการตรวจ :</B>

<SELECT NAME="type_diag">
	<Option value="ตรวจวิเคราะห์เพื่อการรักษา">ตรวจวิเคราะห์เพื่อการรักษา</Option>
	<Option value="ตรวจสุขภาพ">ตรวจสุขภาพ</Option>
	<Option value="ประกันสังคมกรณีคลอดบุตร">ประกันสังคมกรณีคลอดบุตร</Option>
</SELECT>
<BR>
<B>ประเภท ฟิล์ม :</B>

<SELECT NAME="type">
							<option value="digital" >digital</option>
							<option value="plain">plain</option>
							<option value="port table">port table</option>
</SELECT>


<INPUT TYPE="hidden" name="ptname" value="<?php echo $arr["ptname"];?>">
<INPUT TYPE="hidden" name="yot" value="<?php echo $yot;?>">
<INPUT TYPE="hidden" name="name" value="<?php echo $pname;?>">
<INPUT TYPE="hidden" name="surname" value="<?php echo $surname;?>">
<INPUT TYPE="hidden" name="hn" value="<?php echo $arr["hn"];?>">
<INPUT TYPE="hidden" name="an" value="<?php echo $arr["an"];?>">
<INPUT TYPE="hidden" name="vn" value="<?php echo $_GET["vn"];?>">
<INPUT TYPE="hidden" name="ptright" value="<?php echo $arr["ptright"];?>">
<INPUT TYPE="hidden" name="dbirth" value="<?php echo $dbirth;?>">
<div id="viewlist">
</div>
</FORM>
</TD>
</TR>
</TABLE>
	</TD>
</TR>
<TR>
	<TD colspan="2">

	<BR>

<!-- 	<TABLE width="70%" border="1" bordercolor="#3366FF">
<TR>
	<TD  align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">
		รายการ xray ที่เคยสั่ง
	</TD>
</TR>
<TR>
	<TD>
<TABLE width="100%" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR align="center">
	<TD>Hn</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>จำนวน xray</TD>
	<TD>ราคา</TD>
	<TD>ยกเลิก</TD>
</TR> -->

<?php
/*
	$d = date("d");
	$m = date("m");
	$yr = date("Y")+543;
    $today="$yr-$m-$d";

	 $sql = "SELECT date,ptname,hn,an,price,row_id,item FROM depart WHERE  date LIKE '$today%' and depart='PATHO' AND xray = 'DR' ";
	 $result = Mysql_Query($sql);
	 while(list($date,$ptname,$hn,$an,$price,$row_id,$item) = Mysql_fetch_row($result)){
		
		echo "
<TR bgcolor=\"#8CE2FF\">
	<TD>".$hn."</TD>
	<TD>".$ptname."</TD>
	<TD align='right'>".$item."&nbsp;&nbsp;&nbsp;</TD>
	<TD align='right'>".$price."&nbsp;&nbsp;&nbsp;</TD>
	<TD align='center'><A HREF=\"del_xray.php?sDate=".urlencode($date)."&nRow_id=$row_id&by=er\" target=\"_blank\">ยกเลิก</TD>
</TR>
<TR  bgcolor=\"#D5F4FF\">
	<TD colspan='5'><TABLE width=\"70%\">
	
	";
	
	$sql = "Select detail, amount From patdata where hn = '".$hn."' AND idno = '".$row_id."' ";
	$result2 = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result2)){
		echo "<TR>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$arr["detail"],"</TD>
		<TD>  จำนวน : ",$arr["amount"],"</TD>
	</TR>";
	}

echo "</TABLE>
	</TD>
</TR>";

	 }*/
?>
<!-- </TABLE>


	</TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE> -->


</body>
</html>
<?php include("unconnect.inc");?>