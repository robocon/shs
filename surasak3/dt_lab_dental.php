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

	$sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

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

//************************** แสดงรายการ lab  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){

$count = count($_SESSION["list_code"]);

	echo "<FORM METHOD=POST ACTION=\"dt_add_lab.php\" NAME=\"form_list\">
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
	echo "<TR align=\"center\">
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
	$list_lab_check[$i]["code"] = "62101";
	$list_lab_check[$i]["detail"] = "62101";
$i++;

	$list_lab_check[$i]["code"] = "62102";
	$list_lab_check[$i]["detail"] = "62102";
$i++;

	$list_lab_check[$i]["code"] = "62104";
	$list_lab_check[$i]["detail"] = "62104";
$i++;

	$list_lab_check[$i]["code"] = "62106";
	$list_lab_check[$i]["detail"] = "62106";
$i++;

	$list_lab_check[$i]["code"] = "62210";
	$list_lab_check[$i]["detail"] = "62210";
$i++;

	$list_lab_check[$i]["code"] = "62211";
	$list_lab_check[$i]["detail"] = "62211";
$i++;

	$list_lab_check[$i]["code"] = "62214";
	$list_lab_check[$i]["detail"] = "62214";
$i++;

	$list_lab_check[$i]["code"] = "62216";
	$list_lab_check[$i]["detail"] = "62216";
$i++;

	$list_lab_check[$i]["code"] = "62500";
	$list_lab_check[$i]["detail"] = "62500";
$i++;

	$list_lab_check[$i]["code"] = "62501";
	$list_lab_check[$i]["detail"] = "62501";
$i++;

	$list_lab_check[$i]["code"] = "62502";
	$list_lab_check[$i]["detail"] = "62502";
$i++;

	$list_lab_check[$i]["code"] = "62503";
	$list_lab_check[$i]["detail"] = "62503";
$i++;

	$list_lab_check[$i]["code"] = "63110";
	$list_lab_check[$i]["detail"] = "63110";
$i++;

	$list_lab_check[$i]["code"] = "64101";
	$list_lab_check[$i]["detail"] = "64101";
$i++;

	$list_lab_check[$i]["code"] = "64102";
	$list_lab_check[$i]["detail"] = "64102";
$i++;

	$list_lab_check[$i]["code"] = "67101";
	$list_lab_check[$i]["detail"] = "67101";
$i++;

	$list_lab_check[$i]["code"] = "67201";
	$list_lab_check[$i]["detail"] = "67201";
$i++;

	$list_lab_check[$i]["code"] = "67202";
	$list_lab_check[$i]["detail"] = "67202";
$i++;

	$list_lab_check[$i]["code"] = "67203";
	$list_lab_check[$i]["detail"] = "67203";
$i++;

	$list_lab_check[$i]["code"] = "67210";
	$list_lab_check[$i]["detail"] = "67210";
$i++;

	$list_lab_check[$i]["code"] = "67211";
	$list_lab_check[$i]["detail"] = "67211";
$i++;

	$list_lab_check[$i]["code"] = "67212";
	$list_lab_check[$i]["detail"] = "67212";
$i++;

	$list_lab_check[$i]["code"] = "67213";
	$list_lab_check[$i]["detail"] = "67213";


	$r=5;
	$count = count($list_lab_check);

?>

<TABLE width="100%" border="0">
<TR valign="top">
	<TD width="500">
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >ตรวจLAB อื่นๆ ระบุ : <INPUT TYPE="text" NAME="" size="13" onkeypress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		echo "<TD align='right' >";
			//echo "<INPUT TYPE=\"checkbox\" NAME=\"\" id=\"".jschars($list_lab_check[$i-1]["code"])."\" >";
		echo "</TD>";
		echo "<TD><a href ='javascript:void(0);' onclick=\"addbycheck('".jschars($list_lab_check[$i-1]["code"])."');\" >".jschars($list_lab_check[$i-1]["detail"])."</a></TD>";
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