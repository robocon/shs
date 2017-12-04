<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?php
//Update 31 พค. 53 bbm
//    $cHn="";
 session_start();


 if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");   

if(isset($_GET["action"])  && $_GET["action"] == "viewlist"){

	
	$count = count($_SESSION["list_code"]);
	
	echo "<A HREF=\"javascript:show_bock();\">เจาะเลือด</A>
	<TABLE bgcolor='#FFFFD2'>
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

	//************************** แสดงรายการ lab  ********************************************************

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
	
	echo $_SESSION["list_code"][$i];


	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:720px; height:430px; overflow:auto; \">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>รายละเอียด</strong></font></td>
			<td width=\"24\"><font><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">ปิด</A></strong></font></td>
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


session_register("list_code");
session_register("list_detail");
$_SESSION["list_code"] = array();
$_SESSION["list_detail"] = array();

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

$cdate_appoint=date("Y-m-d H:i:s");
$query = "SELECT bed,date_format(date,'%d- %m- %Y'),ptname,age,an,hn,diagnos,food,
                    doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,status,diag1 FROM bed WHERE an='$an'";
  
    $result = mysql_query($query)
        or die("Query failed");

list ($bed,$date,$ptname,$age,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,
                      $bedcode,$hn,$status,$diag1) = mysql_fetch_row ($result);

   
//$dbirth="$y-$m-$d"; เก็บวันเกิดใน opcard= "$y-$m-$d" ซึ่ง=$birth in function
// print "<p><b><font face='Angsana New' size = '3'>โรงพยาบาลค่ายสุรศักดิ์มนตรี</font></b></p>";
   print "<p><font class='forntsarabun' size = '4'>ชื่อ $ptname  HN: $hn อายุ $age &nbsp;<B>สิทธิ:$ptright</font></B><br>";
  print "<font class='forntsarabun' size = '4'>แพทย์ $doctor </font></B></p>";

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

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'wpreappoi.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();

	//if(checkELyte() == "4"){
	//	alert("ท่านได้สั่งรายการ Na, K, Cl, Co2 แยกทั้ง 4 รายการ \n กรุณาสั่งเป็น E'Lyte ");
	//}
}

function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'wpreappoi.php?action=viewlist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("list_patho").innerHTML = xmlhttp.responseText;
	document.getElementById("list").innerHTML = "";
}

function del_list(code){

	url = 'wpreappoi.php?action=delete&code=' + code;
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

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'wpreappoi.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display=''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

</SCRIPT>

<TABLE border="0" class="forntsarabun">
<TR valign="top">
	<TD>
<form method="POST" action="wappinsert1.php?an=<?=$an;?>&cBed=<?=$bed;?>& cBedcode=<?=$bedcode;?>&cbedname=หอผู้ป่วยหญิง">
 
  <div id="list_patho"><font class="forntsarabun"><A HREF="javascript:show_bock();">เจาะเลือด</A></font></div>
  
  &nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1" class="forntsarabun">

  </form>
</TD>
	<TD>
	
	<?php
$i=0;
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

	$r=5;
	$count = count($list_lab_check);

?>

<TABLE id="bock_lab" width="100%" border="1" bordercolor='#000000' cellpadding="3" cellspacing="0" style="display:none;">
<TR valign="top">
	<TD width="500" >
	<div align="center"><B>รายการตรวจทางพยาธิ</B></div>
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >ตรวจLAB อื่นๆ ระบุ : <INPUT TYPE="text" NAME="" size="13" onkeypress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		
		echo "<TD><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".jschars($list_lab_check[$i-1]["code"])."');\" >".jschars($list_lab_check[$i-1]["detail"])."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}
?>
</TR>
<TR>
	<TD colspan="<?php echo $r*2;?>">
	
		<?php
			/*$sql = "Select code, detail From labcare where left(code,3) ='DR@' ";
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
			}*/
		?>
	</TD>
</TR>
</TABLE>
	
	</TD>
</TR>
</TABLE>

<?php  include("unconnect.inc");?>