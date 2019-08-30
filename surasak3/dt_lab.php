<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

$_SESSION["list_lab"] = array() ;



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
if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$sql = "Select code, detail,price,chkup From labcare where labstatus = 'Y' AND (code like '%".$_GET["search"]."%' || codex like '%".$_GET["search"]."%' || detail like '%".$_GET["search"]."%') Order by numbered ASC";

	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:720px; height:430px; overflow:auto; \">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"20\"><font style=\"color: #FFFFFF\"></font></td>
			<td width=\"500\"><font style=\"color: #FFFFFF\"><strong>รายละเอียด</strong></font></td>
			<td width=\"156\"><font style=\"color: #FFFFFF\"><strong>ราคา</strong></font></td>
			<td width=\"24\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></strong></font></td>
		</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";


				if($arr["chkup"]=="12" || $arr["chkup"]=="1234" || $arr["chkup"]=="34"){
					$chkup=" (ตรวจสุขภาพ)";
				}
				$arr["detail"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["detail"]);


			echo "<tr bgcolor=\"$bgcolor\">
					<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)addtolist('".$arr["code"]."'); \" ondblclick=\"addtolist('".$arr["code"]."'); \"></td>
					<td bgcolor=\"$bgcolor\">",$arr["detail"].$chkup,"</td>
					<td bgcolor=\"$bgcolor\" align=\"right\">",$arr["price"],"</td>
					<td bgcolor=\"$bgcolor\">&nbsp;</td>
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

//************************** แสดงรายการ lab  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){

$count = count($_SESSION["list_code"]);

	echo "<FORM METHOD=POST ACTION=\"dt_add_lab_dr.php\" NAME=\"form_list\">
	<TABLE ID=\"main_tb\" width=\"98%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" >
		<TR class=\"tb_head\" >
			<TD rowspan=\"2\" width=\"20\"><INPUT TYPE=\"checkbox\" NAME=\"\"></TD>
			<TD rowspan=\"2\">รายการ</TD>
			<TD colspan=\"2\" width=\"120\">ราคา</TD>
		</TR>
		<TR class=\"tb_head\" >
			<TD width=\"60\">เบิกได้</TD>
			<TD width=\"60\">เบิกไม่ได้</TD>
		</TR>";

for($i=0;$i<$count;$i++){
	
	if($i%2==0)
		$color= "#FFFFCC";
	else
		$color= "#FFFFFF";

		echo "<TR bgcolor=\"".$color."\">
			<TD width=\"20\" align=\"center\">
				<INPUT TYPE=\"checkbox\" NAME=\"code[]\" value=\"".$_SESSION["list_code"][$i]."\">
			</TD>
			<TD>".$_SESSION["list_detail"][$i]."</TD>
			<TD align=\"right\">".$_SESSION["list_yprice"][$i]."</TD>
			<TD align=\"right\">".$_SESSION["list_nprice"][$i]."</TD>
		</TR>";
}
	if($count > 0){
	echo "<TR align=\"center\" class=\"tb_head\">
	<TD colspan=\"2\">ราคารวม : ".(array_sum($_SESSION["list_yprice"])+array_sum($_SESSION["list_nprice"]))."</TD>
	<TD align=\"right\">".array_sum($_SESSION["list_yprice"])."</TD>
	<TD align=\"right\">".array_sum($_SESSION["list_nprice"])."</TD>
</TR>";

	echo "<TR align=\"center\">
	<TD width=\"20\"><INPUT TYPE=\"button\" value=\" ลบ \" onclick=\"mutidel_list();\"></TD>
	<TD colspan=\"3\"><INPUT TYPE=\"button\" onclick=\"document.getElementById('main_tb').style.display='none';document.getElementById('main_tb2').style.display='';\" value=\" ตกลง \" ></TD>
</TR>";
	}
	echo "</TABLE>

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
<INPUT TYPE=\"hidden\" name=\"priority\" value=\"R\">
</FORM>";
	exit();

}


//************************** แสดงรายการ lab  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){
	$sql = "Select detail, yprice, nprice From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);

	array_push($_SESSION["list_nprice"],$nprice);
	array_push($_SESSION["list_yprice"],$yprice);

	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "checkELyte"){
	
	$array_e = array('Na','k','Cl','co2');

	$result = array_intersect($_SESSION["list_code"], $array_e);

	echo count($result);


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
<title>สั่งตรวจ LAB Online</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
</head>
<body>

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
			url = 'dt_lab.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display=''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'dt_lab.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();
	document.getElementById('list').innerHTML='';
	document.getElementById('list').style.display='none';
	if(checkELyte() == "4"){
		alert("ท่านได้สั่งรายการ Na, K, Cl, Co2 แยกทั้ง 4 รายการ \n กรุณาสั่งเป็น E'Lyte ");
	}
}

function addbycheck(statuscheck, code){

	if(statuscheck == true){
		addtolist(code);
	}else if(statuscheck == false){
		del_list(code);
		viewlist();
	}

}

function addsuittolist(suil){
	
	var code = suil.split('][');
	if(code.length > 0){
		for(i=0;i<code.length;i++)
			addtolist(code[i]);
	}

}

function checkELyte(){
	var txtreturn;
	xmlhttp = newXmlHttp();
	url = 'dt_lab.php?action=checkELyte';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	txtreturn = xmlhttp.responseText;
	txtreturn = txtreturn.substr(4);
	return txtreturn;
}



function viewlist(){
	
	url = 'dt_lab.php?action=viewtolist';

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("viewlist").innerHTML = xmlhttp.responseText;
	
}

function del_list(code){

	url = 'dt_lab.php?action=delete&code=' + code;
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

<?php include("dt_menu.php");?><BR>
<?php 

$style_menu="2";
include("dt_patient.php");?>

<?php
$i=0;
$sql2 = "select * from labcare where lab_list !=0 order by lab_list asc";
$rows2=mysql_query($sql2);
while($result2=mysql_fetch_array($rows2)){	
	$list_lab_check[$i]["code"] = $result2['code'];
	$list_lab_check[$i]["detail"] = $result2['lab_listdetail'];
	$i++;
}
/*$i=0;
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
$i++;

	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
$i++;

	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";
$i++;

	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
$i++;

	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
$i++;

	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";
$i++;

	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TRI";
$i++;

	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
$i++;

	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
$i++;

	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
$i++;

	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
$i++;

	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";
$i++;

	$list_lab_check[$i]["code"] = "E";
	$list_lab_check[$i]["detail"] = "E'Lyte";
$i++;

	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
$i++;

	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
$i++;

	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
$i++;

	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
$i++;

	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
$i++;

	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
$i++;

	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
$i++;

	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
$i++;

	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
$i++;

	$list_lab_check[$i]["code"] = "BG";
	$list_lab_check[$i]["detail"] = "BG";
$i++;

	$list_lab_check[$i]["code"] = "PH";
	$list_lab_check[$i]["detail"] = "PHOS";
$i++;

	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";
$i++;

	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
$i++;

	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
$i++;

	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";
$i++;

	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";
$i++;

	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
$i++;

	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
$i++;

	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
$i++;

	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "CA";
$i++;

	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Albumin";
//************

$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

$i++;
$list_lab_check[$i]["code"] = "k";
$list_lab_check[$i]["detail"] = "K";

$i++;
$list_lab_check[$i]["code"] = "Cl";
$list_lab_check[$i]["detail"] = "Cl";

$i++;
$list_lab_check[$i]["code"] = "co2";
$list_lab_check[$i]["detail"] = "CO2";

$i++;
$list_lab_check[$i]["code"] = "PTT";
$list_lab_check[$i]["detail"] = "PTT.Ratio";

$i++;
$list_lab_check[$i]["code"] = "PT";
$list_lab_check[$i]["detail"] = "PT,INR";*/
if( $_SESSION['sIdname'] == 'md19364' ){
$i=0;
	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
	
$i++;
	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";

$i++;
	$list_lab_check[$i]["code"] = "10530";
	$list_lab_check[$i]["detail"] = "HIV VL";
	
$i++;
	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
	
$i++;
	$list_lab_check[$i]["code"] = "10508";
	$list_lab_check[$i]["detail"] = "HBeAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBeAg";
	$list_lab_check[$i]["detail"] = "HBeAg titer";

$i++;
	$list_lab_check[$i]["code"] = "HBV-VL";
	$list_lab_check[$i]["detail"] = "HBV VL";

$i++;
	$list_lab_check[$i]["code"] = "HCV-VL";
	$list_lab_check[$i]["detail"] = "HCV VL";

$i++;
	$list_lab_check[$i]["code"] = "HCV-Ge";
	$list_lab_check[$i]["detail"] = "HCV genotype";

$i++;
	$list_lab_check[$i]["code"] = "HBTY";
	$list_lab_check[$i]["detail"] = "Hb typing";
		
$i++;
	$list_lab_check[$i]["code"] = "ESR";
	$list_lab_check[$i]["detail"] = "ESR";	

$i++;
	$list_lab_check[$i]["code"] = "CRP";
	$list_lab_check[$i]["detail"] = "CRP";
$i++;
	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
	
$i++;
	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
	
$i++;
	$list_lab_check[$i]["code"] = "LIPID";
	$list_lab_check[$i]["detail"] = "Lipid";

$i++;
	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";

$i++;
	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TG";
	
$i++;
	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
	
$i++;
	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
	
$i++;
	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
	
$i++;
	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";

$i++;
	$list_lab_check[$i]["code"] = "E";
	$list_lab_check[$i]["detail"] = "E'Lyte";
	
$i++;
	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
	
$i++;
	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
	
$i++;
	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
	
$i++;
	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
	
$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Alb";
	
$i++;	
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
	
$i++;
	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
	
$i++;
	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
	
$i++;
	$list_lab_check[$i]["code"] = "BG";
	$list_lab_check[$i]["detail"] = "BG";

$i++;
	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
	
$i++;
	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
	
$i++;
	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
	
$i++;
	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
	
$i++;
	$list_lab_check[$i]["code"] = "RF";
	$list_lab_check[$i]["detail"] = "RF";
	
$i++;
	$list_lab_check[$i]["code"] = "PSA";
	$list_lab_check[$i]["detail"] = "PSA";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANA";

$i++;
	$list_lab_check[$i]["code"] = "AFP";
	$list_lab_check[$i]["detail"] = "AFP";
	
$i++;
	$list_lab_check[$i]["code"] = "CPK";
	$list_lab_check[$i]["detail"] = "CPK";
	
/* $i++;
	$list_lab_check[$i]["code"] = "10212";
	$list_lab_check[$i]["detail"] = "Stool exam"; */

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Stool C/S";

$i++;
	$list_lab_check[$i]["code"] = "STOCB";
	$list_lab_check[$i]["detail"] = "Stool occult blood";

$i++;
	$list_lab_check[$i]["code"] = "AFB";
	$list_lab_check[$i]["detail"] = "AFB";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Sputum C/S";

$i++;
	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";

$i++;
	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "Ca";


//************

$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

$i++;
	$list_lab_check[$i]["code"] = "k";
	$list_lab_check[$i]["detail"] = "K";

$i++;
	$list_lab_check[$i]["code"] = "Cl";
	$list_lab_check[$i]["detail"] = "Cl";

$i++;
	$list_lab_check[$i]["code"] = "co2";
	$list_lab_check[$i]["detail"] = "CO2";

$i++;
	$list_lab_check[$i]["code"] = "PH";
	$list_lab_check[$i]["detail"] = "P";

$i++;
	$list_lab_check[$i]["code"] = "MAG";
	$list_lab_check[$i]["detail"] = "Mg";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "Iron";
	
$i++;
	$list_lab_check[$i]["code"] = "10245";
	$list_lab_check[$i]["detail"] = "Zinc";

$i++;
	$list_lab_check[$i]["code"] = "10362";
	$list_lab_check[$i]["detail"] = "Copper";

$i++;
	$list_lab_check[$i]["code"] = "10360";
	$list_lab_check[$i]["detail"] = "Cadmium";

$i++;
	$list_lab_check[$i]["code"] = "PT";
	$list_lab_check[$i]["detail"] = "PT,INR";

$i++;
	$list_lab_check[$i]["code"] = "BLTI";
	$list_lab_check[$i]["detail"] = "Bleeding time";

$i++;
	$list_lab_check[$i]["code"] = "FER";
	$list_lab_check[$i]["detail"] = "SF";

$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "SI";

$i++;
	$list_lab_check[$i]["code"] = "TIBC";
	$list_lab_check[$i]["detail"] = "TIBC";

$i++;
	$list_lab_check[$i]["code"] = "10979";
	$list_lab_check[$i]["detail"] = "IPTH";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANCA";

$i++;
	$list_lab_check[$i]["code"] = "10617";
	$list_lab_check[$i]["detail"] = "C3";

$i++;
	$list_lab_check[$i]["code"] = "10623";
	$list_lab_check[$i]["detail"] = "C4";

$i++;
	$list_lab_check[$i]["code"] = "ASO";
	$list_lab_check[$i]["detail"] = "ASOtiter";
	
$i++;
	$list_lab_check[$i]["code"] = "PTT";
	$list_lab_check[$i]["detail"] = "PTT,Ratio";
	
$i++;
	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN2";

$i++;
	$list_lab_check[$i]["code"] = "BUNHD";
	$list_lab_check[$i]["detail"] = "BUN3";
	
$i++;
	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT";
	$list_lab_check[$i]["detail"] = "Urine Protein";

$i++;
	$list_lab_check[$i]["code"] = "U-CR";
	$list_lab_check[$i]["detail"] = "Urine Cr";
	
$i++;
	$list_lab_check[$i]["code"] = "10421";
	$list_lab_check[$i]["detail"] = "Urine Microalbumin";
	
$i++;
	$list_lab_check[$i]["code"] = "U-PROT24";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Vol";
$i++;
	$list_lab_check[$i]["code"] = "10516-500";
	$list_lab_check[$i]["detail"] = "HBs-Ag titer";
}else{
$i=0;
	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
	
$i++;
	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
	
$i++;
	$list_lab_check[$i]["code"] = "LIPID";
	$list_lab_check[$i]["detail"] = "Lipid";

$i++;
	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";

$i++;
	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TG";
	
$i++;
	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
	
$i++;
	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
	
$i++;
	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
	
$i++;
	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";

$i++;
	$list_lab_check[$i]["code"] = "E";
	$list_lab_check[$i]["detail"] = "E'Lyte";
	
$i++;
	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
	
$i++;
	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
	
$i++;
	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
	
$i++;
	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
	
$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Alb";
	
$i++;	
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
	
$i++;
	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
	
$i++;
	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
	
$i++;
	$list_lab_check[$i]["code"] = "BG";
	$list_lab_check[$i]["detail"] = "BG";

$i++;
	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
	
$i++;
	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
	
$i++;
	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
	
$i++;
	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
	
$i++;
	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
	
$i++;
	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";

$i++;
	$list_lab_check[$i]["code"] = "10530";
	$list_lab_check[$i]["detail"] = "HIV VL";
	
$i++;
	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
	
$i++;
	$list_lab_check[$i]["code"] = "10508";
	$list_lab_check[$i]["detail"] = "HBeAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBeAg";
	$list_lab_check[$i]["detail"] = "HBeAg titer";

$i++;
	$list_lab_check[$i]["code"] = "HBV-VL";
	$list_lab_check[$i]["detail"] = "HBV VL";

$i++;
	$list_lab_check[$i]["code"] = "HCV-VL";
	$list_lab_check[$i]["detail"] = "HCV VL";

$i++;
	$list_lab_check[$i]["code"] = "HCV-Ge";
	$list_lab_check[$i]["detail"] = "HCV genotype";

$i++;
	$list_lab_check[$i]["code"] = "HBTY";
	$list_lab_check[$i]["detail"] = "Hb typing";
		
$i++;
	$list_lab_check[$i]["code"] = "ESR";
	$list_lab_check[$i]["detail"] = "ESR";	

$i++;
	$list_lab_check[$i]["code"] = "CRP";
	$list_lab_check[$i]["detail"] = "CRP";

$i++;
	$list_lab_check[$i]["code"] = "RF";
	$list_lab_check[$i]["detail"] = "RF";
	
$i++;
	$list_lab_check[$i]["code"] = "PSA";
	$list_lab_check[$i]["detail"] = "PSA";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANA";

$i++;
	$list_lab_check[$i]["code"] = "AFP";
	$list_lab_check[$i]["detail"] = "AFP";
	
$i++;
	$list_lab_check[$i]["code"] = "CPK";
	$list_lab_check[$i]["detail"] = "CPK";
	
/* $i++;
	$list_lab_check[$i]["code"] = "10212";
	$list_lab_check[$i]["detail"] = "Stool exam"; */

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Stool C/S";

$i++;
	$list_lab_check[$i]["code"] = "STOCB";
	$list_lab_check[$i]["detail"] = "Stool occult blood";

$i++;
	$list_lab_check[$i]["code"] = "AFB";
	$list_lab_check[$i]["detail"] = "AFB";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Sputum C/S";

$i++;
	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";

$i++;
	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "Ca";


//************

$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

$i++;
	$list_lab_check[$i]["code"] = "k";
	$list_lab_check[$i]["detail"] = "K";

$i++;
	$list_lab_check[$i]["code"] = "Cl";
	$list_lab_check[$i]["detail"] = "Cl";

$i++;
	$list_lab_check[$i]["code"] = "co2";
	$list_lab_check[$i]["detail"] = "CO2";

$i++;
	$list_lab_check[$i]["code"] = "PH";
	$list_lab_check[$i]["detail"] = "P";

$i++;
	$list_lab_check[$i]["code"] = "MAG";
	$list_lab_check[$i]["detail"] = "Mg";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "Iron";
	
$i++;
	$list_lab_check[$i]["code"] = "10245";
	$list_lab_check[$i]["detail"] = "Zinc";

$i++;
	$list_lab_check[$i]["code"] = "10362";
	$list_lab_check[$i]["detail"] = "Copper";

$i++;
	$list_lab_check[$i]["code"] = "10360";
	$list_lab_check[$i]["detail"] = "Cadmium";

$i++;
	$list_lab_check[$i]["code"] = "PT";
	$list_lab_check[$i]["detail"] = "PT,INR";

$i++;
	$list_lab_check[$i]["code"] = "BLTI";
	$list_lab_check[$i]["detail"] = "Bleeding time";

$i++;
	$list_lab_check[$i]["code"] = "FER";
	$list_lab_check[$i]["detail"] = "SF";

$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "SI";

$i++;
	$list_lab_check[$i]["code"] = "TIBC";
	$list_lab_check[$i]["detail"] = "TIBC";

$i++;
	$list_lab_check[$i]["code"] = "10979";
	$list_lab_check[$i]["detail"] = "IPTH";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANCA";

$i++;
	$list_lab_check[$i]["code"] = "10617";
	$list_lab_check[$i]["detail"] = "C3";

$i++;
	$list_lab_check[$i]["code"] = "10623";
	$list_lab_check[$i]["detail"] = "C4";

$i++;
	$list_lab_check[$i]["code"] = "ASO";
	$list_lab_check[$i]["detail"] = "ASOtiter";
	
$i++;
	$list_lab_check[$i]["code"] = "PTT";
	$list_lab_check[$i]["detail"] = "PTT,Ratio";
	
$i++;
	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN2";

$i++;
	$list_lab_check[$i]["code"] = "BUNHD";
	$list_lab_check[$i]["detail"] = "BUN3";
	
$i++;
	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT";
	$list_lab_check[$i]["detail"] = "Urine Protein";

$i++;
	$list_lab_check[$i]["code"] = "U-CR";
	$list_lab_check[$i]["detail"] = "Urine Cr";
	
$i++;
	$list_lab_check[$i]["code"] = "10421";
	$list_lab_check[$i]["detail"] = "Urine Microalbumin";
	
$i++;
	$list_lab_check[$i]["code"] = "U-PROT24";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Vol";
$i++;
	$list_lab_check[$i]["code"] = "10516-500";
	$list_lab_check[$i]["detail"] = "HBs-Ag titer";
}
	$r=4;
	$count = count($list_lab_check);

?>

<TABLE width="100%" border="0">
<TR valign="top">
	<TD width="500">
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >สั่งตรวจLAB อื่นๆ ระบุ : 
	  <INPUT TYPE="text" NAME="" size="13" onKeyPress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		echo "<TD align='right' >";
			echo "<INPUT TYPE=\"checkbox\" NAME=\"\" TYPE=\"checkbox\"  id=\"".jschars($list_lab_check[$i-1]["code"])."\" onclick=\"addbycheck(this.checked, '".jschars($list_lab_check[$i-1]["code"])."');\">";
		echo "</TD>";
		echo "<TD>".jschars($list_lab_check[$i-1]["detail"])."</TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}
?>
</TR>
<TR>
	<TD colspan="<?php echo $r*2;?>">
	
		<?php
			$sql = "Select code, detail From labcare where left(code,3) ='DR@' ";
			$result = Mysql_Query($sql);
			if(Mysql_num_rows($result) > 0){
				echo "สูตร LAB<BR>";
			while($arr = Mysql_fetch_assoc($result)){
				$i=0;
				$list = array();
				$sql2 = "Select code From labsuit where suitcode = '".$arr["code"]."' ";
				$result2 = Mysql_Query($sql2);
				while($arr2 = Mysql_fetch_assoc($result2)){
					$list[$i] = $arr2["code"];
					$i++;
				}

				echo "<A HREF=\"#\" Onclick=\"addsuittolist('".implode("][",$list)."');\">".$arr["detail"]."</A><BR>";
			}		
			}
		?>
	</TD>
</TR>
</TABLE>




</TD>
	<TD align="center">
<div id="viewlist">
<!-- list lab -->
		<TABLE width="98%" border="0" cellpadding="3" cellspacing="0">
		<TR class="tb_head" >
			<TD rowspan="2" width="20"><INPUT TYPE="checkbox" NAME=""></TD>
			<TD rowspan="2">รายการ</TD>
			<TD colspan="2" width="120">ราคา</TD>
		</TR>
		<TR class="tb_head" >
			<TD width="60">เบิกได้</TD>
			<TD width="60">เบิกไม่ได้</TD>
		</TR>
		</TABLE>

</div>
	</TD>
</TR>
</TABLE>

</body>
<?php include("unconnect.inc");?>
</html>