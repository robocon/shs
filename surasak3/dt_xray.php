<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

if(empty($_SESSION["S_listxray"])){
	session_register("S_listxray");
	$_SESSION["S_listxray"] = array();
}

include("connect.inc");
$style_menu=2;



if($_GET["action"] == "select"){

echo "2.&nbsp;<SELECT NAME=\"choice2\">";

	$sql = "Select code, detail From xraytype where h_code = '".$_GET["search"]."' order by detail ASC ";
	$result = Mysql_Query($sql);
	while(list($code, $detail) = Mysql_fetch_row($result)){
		echo "<Option value=\"".$code."\">".$detail."</Option>";
	}

echo "</SELECT>";
exit();
}else if($_GET["action"] == "addxray"){
	


	$count = count($_SESSION["S_listxray"]);
	$_SESSION["S_listxray"][$count]["choice1"] = $_GET["choice1"];
	$_SESSION["S_listxray"][$count]["choice2"] = $_GET["choice2"];
	$_SESSION["S_listxray"][$count]["amount"] = $_GET["amount"];
	$_SESSION["S_listxray"][$count]["type"] = $_GET["type"];

	
	exit();

}else if($_GET["action"] == "delxray"){
	

	$count = count($_SESSION["S_listxray"]);
	for($i=$_GET["id"];$i<$count;$i++){

	$_SESSION["S_listxray"][$i] = $_SESSION["S_listxray"][$i+1];

	}

	unset($_SESSION["S_listxray"][$count-1]);

}else if($_GET["action"] == "vieworder"){
	
	$count = count($_SESSION["S_listxray"]);
		
	echo "
	<FORM METHOD=POST ACTION=\"dt_add_xray.php\">
	<TABLE width=\"100%\">
	<TR  class='tb_head'>
		<TD width=\"30\">ลบ</TD>
		<TD width=\"330\">X-Ray</TD>
	</TR>";
	$style="style=\"background-color: #FFFFC1;\" ";	
	for($i=0;$i<$count;$i++){

		if($i%2==0)
			$style="style=\"background-color: #FFFFCA;\" ";	
		else
			$style="style=\"background-color: #FFFFAE;\" ";	

	echo "
	<TR ".$style.">
		<TD align=\"center\"  width=\"30\"><INPUT TYPE=\"checkbox\" ID=\"index_value",$i,"\" NAME=\"index_value",$i,"\" value=\"",$i,"\"></TD>
		<TD>&nbsp;&nbsp;",$_SESSION["S_listxray"][$i]["choice2"],"</TD>
	</TR>
		";
	}
	if($count > 0){
	echo "
	<TR ".$style.">
		<TD align=\"center\" colspan=\"2\" >
		<B>ประเภทการตรวจ</B> : 
		<SELECT NAME=\"type_diag\">
			<Option value=\"ตรวจวิเคราะห์เพื่อการรักษา\">ตรวจวิเคราะห์เพื่อการรักษา</Option>
			<Option value=\"ตรวจสุขภาพ\">ตรวจสุขภาพ</Option>
			<Option value=\"ประกันสังคมกรณีคลอดบุตร\">ประกันสังคมกรณีคลอดบุตร</Option>
		</SELECT>
		</TD>
	</TR>
		";
	echo "
	<TR ".$style.">
		<TD align=\"center\" colspan=\"2\" >
		ประเภท : <SELECT NAME=\"type\"  name=\"type\" id=\"type\">
							<option value=\"digital\" >digital</option>
							<option value=\"plain\">plain</option>
							<option value=\"port table\">port table</option>
						</SELECT>
		</TD>
	</TR>
		";
	echo "
	<TR >
		<TD  width=\"30\" align=\"center\"><INPUT TYPE=\"button\" name=\"del\" value=\" ลบ \" onclick=\"Onclick_del_xray();\"></TD>
		<TD align=\"center\" ><INPUT TYPE=\"submit\" value=\"    ตกลง    \"></TD>
	</TR>
		";
	}
	echo "
	</TABLE>
		<INPUT TYPE=\"hidden\" name=\"amount_index\"  id=\"amount_index\" value=\"",$count,"\">
	</FORM>
	";
	
	exit();

}

session_unregister("nRunno");
session_register("nRunno");

    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'xrayno' limit 1";
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

    $query ="UPDATE runno SET runno = $nRunno WHERE title='xrayno'";
    $result = mysql_query($query) or die("Query failed");

?>
<html>
<head>
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

function ajax_code(url,id_view){

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			if(id_view != '')
				document.getElementById(id_view).innerHTML = xmlhttp.responseText;

}

function select_sub(value) {
	
			
			url = 'dt_xray.php?action=select&search=' + value;
			id_view = "menu2";
			ajax_code(url,id_view);

}

function OnClick_add_xray(xx){

		if(xx != ""){
			//var_choice1 = document.getElementById('menu1').value;
			var_choice2 = xx;
			//var_amount = document.getElementById('amount').value;
			//var_index = document.getElementById('index').value;
			url = 'dt_xray.php?action=addxray&choice2='+ var_choice2;
			id_view = "";
			ajax_code(url,id_view);
			View_order();
			//document.f1.reset();
			//select_sub(document.getElementById("menu1").value);
		}
}

function Onclick_del_xray(){
	
	count = eval(document.getElementById('amount_index').value);
	
	id_view = '';
	for(i=0;i<count;i++){
		//alert(document.getElementById('index_value'+i).checked);
		if(document.getElementById('index_value'+i).checked == true){
			url = 'dt_xray.php?action=delxray&id=' + document.getElementById('index_value'+i).value ;
			ajax_code(url,id_view);
			//alert(url);
		}

	}

			View_order();

}

function Onclick_edit_xray(i,var_choice1,var_choice2,amount,type){

	document.getElementById('menu1').value = var_choice1;
	document.getElementById('choice2').value = var_choice2;
	document.getElementById('amount').value = amount;
	document.getElementById('type').value = type;
	document.getElementById('index').value = i;
}

function View_order(){
	url = 'dt_xray.php?action=vieworder'
	id_view = "view_order";
	ajax_code(url,id_view);

}

function display_page(xx){
	
	if(xx == '2'){
		document.getElementById('display_ly1').style.display = 'none';
		document.getElementById('display_ly2').style.display = '';
	}else{
		document.getElementById('display_ly1').style.display = '';
		document.getElementById('display_ly2').style.display = 'none';
	}

}


</SCRIPT>
<?php include("dt_menu.php");?><BR>
<?php include("dt_patient.php");?>
<BR>
<TABLE border='0' width="100%">
<TR valign="top">
	<!-- <TD width="200"><IMG SRC="body.gif"  BORDER="0" ALT=""></TD> -->
	<TD width="450">

<!-- **************************** เลือกรายการสั่ง X-RAY ****************************** -->
<!-- <FORM name="f1" METHOD=POST ACTION="" onsubmit="return false;">
<TABLE border="1" bordercolor="#F0F000" >
<TR>
	<TD>
1.&nbsp;<SELECT id="menu1" NAME="choice1" onchange="select_sub(this.value);"> -->
<?php
	/*$sql = "Select distinct h_code From xraytype order by h_code ASC";
	$result = Mysql_Query($sql);
	while(list($hn_code) = Mysql_fetch_row($result)){
		echo "<Option value=\"".$hn_code."\">".$hn_code."</Option>";
	}*/
?>
<!-- </SELECT><BR>
<div id="menu2"></div>

	<INPUT TYPE="hidden" value="1" name="amount" id="amount">
	<INPUT TYPE="hidden" value="-" name="index" id="index">
	<INPUT id="add_xray" name="add_xray" TYPE="submit" value="ตกลง" Onclick="OnClick_add_xray();">

</TD>
</TR>
</TABLE>
</FORM> -->
<!-- END **************************** เลือกรายการสั่ง X-RAY ****************************** -->

<!-- First Page -->
<TABLE  cellpadding="2" cellspacing="0">
<TR>
	<TD bgcolor="#005500" style="color:#00FFFF;">
		<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('1');">First Page</A>
	</TD>
	<TD>&nbsp;</TD>
	<TD bgcolor="#004080" style="color:#00FFFF;">
		<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('2');">EXTREMITIES</A>
	</TD>
	<TD>
		Other : <INPUT id="idother" TYPE="text" NAME="" size="10"> <INPUT TYPE="button" value="Add" Onclick="OnClick_add_xray(document.getElementById('idother').value);">
	</TD>
</TR>
</TABLE>


<?php
	$r=2;
	$sql = "Select concat(xraycode,' ',xraysub) as xraydetail From xraylist where xraytype = '0' ";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);
?>
<TABLE  id="display_ly1" width="100%" border="1" bordercolor="#005500" cellpadding="4" cellspacing="0">
<TR>
	<TD>
<TABLE  border="0" width="100%">
<TR >
<?php
$i=1;
	while($arr = mysql_fetch_assoc($result)){
		$bgcolor = "#95FF95";
		$detail = str_replace("'","\'",$arr["xraydetail"]);
		echo "<TD width=\"50%\" style=\"font-family:'Angsana New'; font-size:22px;\" bgcolor=\"".$bgcolor."\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$detail."');\" style=\"text-decoration:none; color:#000099;\">".$arr["xraydetail"]."</A></TD>";
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
	$sql = "Select xraycode , xraysub From xraylist  where xraytype = '3' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
		echo "<TR>";
		
	while($arr = mysql_fetch_assoc($result)){


			$bgcolor = "#95FF95";

		echo "<TD>";
		echo "<TABLE width=\"100%\" bgcolor=\"".$bgcolor."\"><TR><TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">".$arr["xraycode"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." RT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">RT. ".$arr["xraysub"]."</A></TD>";
		echo "</TR>";
		echo "<TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." LT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">LT. ".$arr["xraysub"]."</A></TD></TABLE>";

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

<!-- EXTREMITIES -->
<?php
	$r=2;
	$sql = "Select xraycode , xraysub From xraylist  where xraytype = '1' ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

?>
<TABLE  id="display_ly2" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
<TR>
	<TD>
<TABLE  border="0" width="100%"  cellpadding="4" cellspacing="0">

<?php
$i=1;

		echo "<TR>";
		
	while($arr = mysql_fetch_assoc($result)){


			$bgcolor = "#95FF95";

		echo "<TD>";
		echo "<TABLE width=\"100%\" bgcolor=\"".$bgcolor."\"><TR><TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">".$arr["xraycode"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." RT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">RT. ".$arr["xraysub"]."</A></TD>";
		echo "</TR>";
		echo "<TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('".$arr["xraycode"]." LT. ".$arr["xraysub"]."');\" style=\"text-decoration:none; color:#000099;\">LT. ".$arr["xraysub"]."</A></TD></TABLE>";

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
	<TD>
	<div id="view_order"></div>
	</TD>
</TR>
</TABLE>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	//select_sub(document.getElementById("menu1").value);
	View_order();
}

</SCRIPT>


</body>
<?php include("unconnect.inc");?>
</html>