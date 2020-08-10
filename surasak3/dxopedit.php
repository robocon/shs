<?php
    session_start();
//    session_unregister("sTdatehn");
    $sTdatehn=$cTdatehn;
    session_register("sTdatehn");
	include("connect.inc");
	
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}
	if($sOfficer == ""){
		echo "<CENTER>ขออภัยครับการ Login ของท่านหมดระยะเวลาแล้ว <BR>กรุณา Login ใหม่ด้วยครับ <A HREF=\"../sm3.php\">กลับหน้าแรก</A></CENTER>";
		exit();
	}
	////////////////////////////////////////////////////////////////
	if(isset($_GET["action"]) && $_GET["action"] == "searchicd10"){
	

	$sql = "Select * from  icd10 WHERE (code like '%".$_GET["search"]."%' OR detail LIKE '%".$_GET["search"]."%') limit 10";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; left:600px; top:300px; width:600px; height:150px; overflow:auto; \">";

			echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\"  border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
			<td width=\"5%\"><font style=\"color: #FFFFFF\"><strong>เลือก</strong></font></td>
				<td width=\"20%\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"70%\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"5%\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

	
		if(isset($_GET['num'])){
			$_GET["getto2"]="dt_diag_morbidity".$_GET['num'];
			$_GET["getto"]="dt_icd10_morbidity".$_GET['num'];
		}elseif(isset($_GET['num2'])){
			$_GET["getto2"]="dt_diag_complication".$_GET['num2'];
			$_GET["getto"]="dt_icd10_complication".$_GET['num2'];
		}elseif(isset($_GET['num1'])){
			$_GET["getto2"]="dt_diag_other".$_GET['num1'];
			$_GET["getto"]="dt_icd10_other".$_GET['num1'];
		}elseif(isset($_GET['num5'])){
			$_GET["getto2"]="dt_diag_external".$_GET['num5'];
			$_GET["getto"]="dt_icd10_external".$_GET['num5'];
		}
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
			if(isset($_GET['num'])||isset($_GET['num1'])||isset($_GET['num2'])||isset($_GET['num5'])){
				
//ล๊อครหัส ที่ขึ้นต้นด้วย V,W,X,Y				
if (preg_match("/V/i", $arr["code"]) || preg_match("/W/i", $arr["code"]) || preg_match("/X/i", $arr["code"]) || preg_match("/Y/i", $arr["code"])) {
					
				echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" disabled='disabled'  NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"],"</td><td>$arr[detail]</td></tr>";				
}else {
	echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"],"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";			
}
				

			}else{
				
//ล๊อครหัส ที่ขึ้นต้นด้วย V,W,X,Y				
if (preg_match("/V/i", $arr["code"]) || preg_match("/W/i", $arr["code"]) || preg_match("/X/i", $arr["code"]) || preg_match("/Y/i", $arr["code"])) {
				
				echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\"  disabled='disabled' NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"],"</td><td>$arr[detail]</td></tr>";
			
}else{
		echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"],"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";	
	
}
			
			}
		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
//////////////////////////////////////////ตัวช่วย PRINCIPLE////////////////////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "searchicd10a"){
	
	$sql = "Select * from  icd10 WHERE (code like '%".$_GET["search"]."%' OR detail LIKE '%".$_GET["search"]."%') limit 10";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; left:500px; top:250px; width:600px; height:150px; overflow:auto; \">";
			echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\"  border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
			<td width=\"5%\"><font style=\"color: #FFFFFF\"><strong>เลือก</strong></font></td>
				<td width=\"20%\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"70%\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"5%\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

	
		if(isset($_GET['num'])){
			$_GET["getto2"]="dt_diag_morbiditya".$_GET['num'];
			$_GET["getto"]="dt_icd10_morbiditya".$_GET['num'];
		}elseif(isset($_GET['num2'])){
			$_GET["getto2"]="dt_diag_complicationa".$_GET['num2'];
			$_GET["getto"]="dt_icd10_complicationa".$_GET['num2'];
		}elseif(isset($_GET['num1'])){
			$_GET["getto2"]="dt_diag_othera".$_GET['num1'];
			$_GET["getto"]="dt_icd10_othera".$_GET['num1'];
		}elseif(isset($_GET['num5'])){
			$_GET["getto2"]="dt_diag_externala".$_GET['num5'];
			$_GET["getto"]="dt_icd10_externala".$_GET['num5'];
		}
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
					
					


if(isset($_GET['num'])||isset($_GET['num1'])||isset($_GET['num2'])||isset($_GET['num5'])){
	
//ล๊อครหัส ที่ขึ้นต้นด้วย V,W,X,Y				
if (preg_match("/V/i", $arr["code"]) || preg_match("/W/i", $arr["code"]) || preg_match("/X/i", $arr["code"]) || preg_match("/Y/i", $arr["code"])) {
	
   echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" disabled='disabled' NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML=''; \"></td><td>",$arr["code"].$a,"</td><td>$arr[detail]</td></tr>";
} else {
	
    echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"].$a,"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";
}	
			

			/*	echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"].$a,"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";*/
			}else{
				
if (preg_match("/V/i", $arr["code"]) || preg_match("/W/i", $arr["code"]) || preg_match("/X/i", $arr["code"]) || preg_match("/Y/i", $arr["code"])) {
	
echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" disabled='disabled'  NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML=''; \"></td><td>",$arr["code"].$a,"</td><td>$arr[detail]</td></tr>";
				
}else{
	
   echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"].$a,"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";
}	
				
				
				
			}
		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
//////////////////////////////////////////



if(isset($_GET["action"]) && $_GET["action"] == "searchicd10b"){
	

	$sql = "Select * from  icd10 WHERE (code like '%".$_GET["search"]."%' OR detail LIKE '%".$_GET["search"]."%') limit 10";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; left:600px; top:600px; width:600px; height:150px; overflow:auto; \">";

			echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\"  border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
			<td width=\"5%\"><font style=\"color: #FFFFFF\"><strong>เลือก</strong></font></td>
				<td width=\"20%\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"70%\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"5%\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

	
		if(isset($_GET['num'])){
			$_GET["getto2"]="dt_diag_morbiditya".$_GET['num'];
			$_GET["getto"]="dt_icd10_morbiditya".$_GET['num'];
		}elseif(isset($_GET['num2'])){
			$_GET["getto2"]="dt_diag_complicationa".$_GET['num2'];
			$_GET["getto"]="dt_icd10_complicationa".$_GET['num2'];
		}elseif(isset($_GET['num1'])){
			$_GET["getto2"]="dt_diag_othera".$_GET['num1'];
			$_GET["getto"]="dt_icd10_othera".$_GET['num1'];
		}elseif(isset($_GET['num5'])){
			$_GET["getto2"]="dt_diag_externala".$_GET['num5'];
			$_GET["getto"]="dt_icd10_externala".$_GET['num5'];
		}
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
					

if(isset($_GET['num'])||isset($_GET['num1'])||isset($_GET['num2'])||isset($_GET['num5'])){
	

	
    echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"].$a,"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";
		
			}else{
				

   echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"].$a,"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"].$a,"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";

			}
		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
//////////////////////////////////////////ตัวช่วย OTHER และ EXTERNAL////////////////////////////////////////////////////////////////
	if(isset($_GET["action"]) && $_GET["action"] == "searchicd10other"){

	$sql = "Select * from  icd10 WHERE (code like '%".$_GET["search"]."%' OR detail LIKE '%".$_GET["search"]."%') limit 10";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; left:500px; top:250px; width:600px; height:150px; overflow:auto; \">";
			echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\"  border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
			<td width=\"5%\"><font style=\"color: #FFFFFF\"><strong>เลือก</strong></font></td>
				<td width=\"20%\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"70%\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"5%\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

	
		if(isset($_GET['num'])){
			$_GET["getto2"]="dt_diag_morbidity".$_GET['num'];
			$_GET["getto"]="dt_icd10_morbidity".$_GET['num'];
		}elseif(isset($_GET['num2'])){
			$_GET["getto2"]="dt_diag_complication".$_GET['num2'];
			$_GET["getto"]="dt_icd10_complication".$_GET['num2'];
		}elseif(isset($_GET['num1'])){
			$_GET["getto2"]="dt_diag_other".$_GET['num1'];
			$_GET["getto"]="dt_icd10_other".$_GET['num1'];
		}elseif(isset($_GET['num5'])){
			$_GET["getto2"]="dt_diag_external".$_GET['num5'];
			$_GET["getto"]="dt_icd10_external".$_GET['num5'];
		}
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
			if(isset($_GET['num'])||isset($_GET['num1'])||isset($_GET['num2'])||isset($_GET['num5'])){
				
				
				
	echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"],"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";				

			}else{
			
		echo "<tr bgcolor=\"$bgcolor\" class='font3'>
				<td ><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\"></td><td>",$arr["code"],"</td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET['getto']."').value = '",$arr["code"],"';document.getElementById('".$_GET['getto2']."').value = '",jschars($arr["detail"]),"';document.getElementById('thaiprin').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A></td></tr>";	

			
			}
		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
//////////////////////////////////////////////////////////////////////


if(isset($_GET["action"]) && $_GET["action"] == "searchicd9cm"){
	
	$sql = "Select code,detail From icd9cm where (code like '%".$_GET["search2"]."%' OR detail LIKE '%".$_GET["search2"]."%' )";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; left:450px; top:100px; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width='100%'>
		<TR >
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
			<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>เลือก</strong>
				<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>ICD9CM</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list1').innerHTML ='';\">Close</A></strong></font></td>
				<td></td>
			</tr>";

		if(isset($_GET['num'])){
			$getto2="icd9cmdetail".$_GET['num'];
			$getto="icd9cm".$_GET['num'];
		}
		$i=1;
		while($arr = mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
			
		
			echo "<tr bgcolor=\"$bgcolor\" class='font3'><td><INPUT id='choice2' TYPE=\"radio\" NAME=\"choice2\"  onkeypress=\"if(event.keyCode==13){ 
			document.getElementById('".$getto."').value = '".$arr["code"]."';
			document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';
			document.getElementById('list1').innerHTML =''; } \" 
			ondblclick=\"document.getElementById('".$getto."').value = '".$arr["code"]."';
			document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';
			document.getElementById('list1').innerHTML ='';\"></td><td>".$arr["code"]."</td>
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" 
					Onclick=\"document.getElementById('".$getto."').value = '".$arr["code"]."';
					document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';
					document.getElementById('list1').innerHTML ='';\">".$arr["detail"]."</A></td></tr>";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
///////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "searchicd9cma"){
	
	$sql = "Select code,detail From icd9cm where (code like '%".$_GET["search2"]."%' OR detail LIKE '%".$_GET["search2"]."%' )";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; left:450px; top:100px; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width='100%'>
		<TR >
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
			<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>เลือก</strong>
				<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>ICD9CM</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list1').innerHTML ='';\">Close</A></strong></font></td>
				<td></td>
			</tr>";

		if(isset($_GET['num'])){
			$getto2="icd9cmdetaila".$_GET['num'];
			$getto="icd9cma".$_GET['num'];
		}
		$i=1;
		while($arr = mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
			
		
			echo "<tr bgcolor=\"$bgcolor\" class='font3'><td><INPUT id='choice2' TYPE=\"radio\" NAME=\"choice2\"  onkeypress=\"if(event.keyCode==13){ 
			document.getElementById('".$getto."').value = '".$arr["code"]."';
			document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';
			document.getElementById('list1').innerHTML =''; } \" 
			ondblclick=\"document.getElementById('".$getto."').value = '".$arr["code"]."';
			document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';
			document.getElementById('list1').innerHTML ='';\"></td><td>".$arr["code"]."</td>
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" 
					Onclick=\"document.getElementById('".$getto."').value = '".$arr["code"]."';
					document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';
					document.getElementById('list1').innerHTML ='';\">".$arr["detail"]."</A></td></tr>";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
?>
<script type="text/javascript">
	   
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



function searchSuggest(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10&search=' + str+'&num=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest1(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10other&search=' + str+'&num1=' + number;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest2(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10&search=' + str+'&num2=' + number;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest3(str,len,getto,getto2) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
		url = 'dxopedit.php?action=searchicd10a&search='+str+'&getto='+getto+'&getto2='+getto2;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest4(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd9cm&search2=' + str+'&num=' + number;
			
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest5(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10other&search=' + str+'&num5=' + number;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest6(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10a&search=' + str+'&num=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest7(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10a&search=' + str+'&num2=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest8(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10b&search=' + str+'&num1=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest9(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd10b&search=' + str+'&num5=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest10(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxopedit.php?action=searchicd9cma&search2=' + str+'&num=' + number;
			
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function addRow()
{ 

	var count_row=document.getElementById('tbExp1').rows.length ;
	if(count_row<16){
		var _table = document.getElementById('tbExp1').insertRow(count_row);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2); 
		//var cell3 = _table.insertCell(3); 
		//var cell4 = _table.insertCell(4);
		var getto = "dt_icd10_morbidity"+count_row;
		var getto2 = "dt_diag_morbidity"+count_row;
		
		cell0.align= "right";
		cell0.innerHTML = 'CO-MORBIDITY';
		cell1.innerHTML = '<input name="dt_icd10_morbidity'+(count_row)+'"  type="text" id="dt_icd10_morbidity'+(count_row)+'" onKeyPress="searchSuggest(this.value,3,'+(count_row)+');" size="8" onKeyDown="radiofocus()">';
		
		
		cell2.innerHTML = '<input name="dt_diag_morbidity'+(count_row)+'"  type="text" id="dt_diag_morbidity'+(count_row)+'" onKeyPress="searchSuggest(this.value,3,'+(count_row)+');" size="40" onKeyDown="radiofocus()">';
		//cell3.innerHTML=  '&nbsp;';
	}
}

function addRow2()
{ 
	var count_row2=document.getElementById('tbExp2').rows.length ;
	if(count_row2<16){
		var _table = document.getElementById('tbExp2').insertRow(count_row2);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2); 
		var cell3 = _table.insertCell(3); 
		var cell4 = _table.insertCell(4);
	//	var cell5 = _table.insertCell(5); 
	//	var cell6 = _table.insertCell(6);
		var getto = "icd9cm"+count_row2;
		var getto2 = "icd9cmdetail"+count_row2;
		
		cell0.align= "right";
		cell0.innerHTML = 'ICD9CM';
		cell1.innerHTML = '<input name="icd9cm'+(count_row2)+'"  type="text" id="icd9cm'+(count_row2)+'" size="8" onKeyPress="searchSuggest4(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();" >';
		cell2.innerHTML = '<input name="icd9cmdetail'+(count_row2)+'"  type="text" id="icd9cmdetail'+(count_row2)+'"  size="40">';
		//cell3.innerHTML = 'วันที่:';
		//cell4.innerHTML = '<input name="icddate'+(count_row2)+'"  type="text" id="icddate'+(count_row2)+'"  size="20">';
		//cell6.innerHTML=  '&nbsp;';
	}
}

function addRow3()
{ 
	var count_row2=document.getElementById('tbExp3').rows.length ;
	if(count_row2<16){
		var _table = document.getElementById('tbExp3').insertRow(count_row2);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2); 
		var cell3 = _table.insertCell(3); 
		var cell4 = _table.insertCell(4);

		cell0.align= "right";
		cell0.innerHTML = 'COMPLICATION';
		cell1.innerHTML = '<input name="dt_icd10_complication'+(count_row2)+'"  type="text" id="dt_icd10_complication'+(count_row2)+'" size="8" onKeyPress="searchSuggest2(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="dt_diag_complication'+(count_row2)+'"  type="text" id="dt_diag_complication'+(count_row2)+'"  size="40" onKeyPress="searchSuggest2(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';

	}
}

function addRow4()
{ 
	var count_row2=document.getElementById('tbExp4').rows.length ;
	if(count_row2<16){
		var _table = document.getElementById('tbExp4').insertRow(count_row2);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2); 
		var cell3 = _table.insertCell(3); 
		var cell4 = _table.insertCell(4);

		cell0.align= "right";
		cell0.innerHTML = 'OTHER';
		cell1.innerHTML = '<input name="dt_icd10_other'+(count_row2)+'"  type="text" id="dt_icd10_other'+(count_row2)+'" size="8" onKeyPress="searchSuggest1(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="dt_diag_other'+(count_row2)+'"  type="text" id="dt_diag_other'+(count_row2)+'"  size="40" onKeyPress="searchSuggest1(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';

	}
}

function addRow5()
{ 
	var count_row2=document.getElementById('tbExp5').rows.length ;
	if(count_row2<16){
		var _table = document.getElementById('tbExp5').insertRow(count_row2);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2); 
		var cell3 = _table.insertCell(3); 
		var cell4 = _table.insertCell(4);

		cell0.align= "right";
		cell0.innerHTML = 'EXTERNAL CAUSE';
		cell1.innerHTML = '<input name="dt_icd10_external'+(count_row2)+'"  type="text" id="dt_icd10_external'+(count_row2)+'" size="8" onKeyPress="searchSuggest5(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="dt_diag_external'+(count_row2)+'"  type="text" id="dt_diag_external'+(count_row2)+'"  size="40" onKeyPress="searchSuggest5(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';

	}
}

function radiofocus(){
	
	if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){
	document.getElementById('choice').focus();
	document.getElementById('choice').checked=true;
	return false;
 }
 
 if(event.keyCode == 40 &&document.getElementById('list1').innerHTML != ''){
	document.getElementById('choice2').focus();
	document.getElementById('choice2').checked=true;
	return false;
	
	 }
}
</script>
<style type="text/css">

.font3 {
	color:#000;
}

</style>
<?
    

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn' AND vn = '".$_GET["cVn"]."' ";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
/*
CREATE TABLE opday (
  row_id int(11) NOT NULL auto_increment,
  thidate datetime default NULL,
  thdatehn varchar(20) default NULL,
  hn varchar(12) NOT NULL default '',
  vn varchar(5) default NULL,
  thdatevn varchar(13) default NULL,
  an varchar(12) default NULL,
  ptname varchar(30) default NULL,
  ptright varchar(32) default NULL,
  goup varchar(24) default NULL,
  camp varchar(24) default NULL,
  dxgroup char(2) default NULL,
  diag varchar(40) default NULL,
  icd10 varchar(8) default NULL,
  doctor varchar(40) default NULL,
  PRIMARY KEY  (row_id),
  KEY thdatehn (thdatehn),
  KEY thdatevn (thdatevn)
) TYPE=MyISAM;
*/
   If ($result){
        //vn,ptname,hn,an,goup,diag,dxgroup
        $cPtname=$row->ptname;
        $cHn=$row->hn;
        $cGoup=$row->goup;
        $cDiag=$row->diag;
       	$cTdate=$row->thidate;
		$cDiag_morbidity  = $row->diag_morbidity;
		$cDiag_complication  = $row->diag_complication;
		$cDiag_other = $row->diag_other;
		$CExternal_cause = $row->external_cause;
		
		$cDoctor=$row->doctor;
        $cDxgroup=$row->dxgroup;
        $cIcd10=$row->icd10;
        $cIcd101=$row->icd101;
		$cIcd10_complication = $row->icd10_complication;
		$cIcd10_other = $row->icd10_other;
		$cIcd10_external_cause = $row->icd10_external_cause;

        $cIcd9cm=$row->icd9cm;
    $cokopd=$row->okopd;
    $cthidate=$row->thidate;
	$thdatehn_value = $row->thdatehn;
	    $Cclinic=$row->clinic;
		
		$ctoborow=$row->toborow;

	$sql = "Select diag, left(toborow,5), left(toborow,4) From opday2 where thdatehn = '".$thdatehn_value."' AND (left(toborow,5) in ('EX 91', 'EX 92') OR left(toborow,4) in ('EX91', 'EX92')) ";
	$result2 = Mysql_Query($sql); 
	while(list($opday2_diag, $toborow, $toborow2) = Mysql_fetch_row($result2)){
		
		if(substr($opday2_diag,0 ,1) == ","){
			$opday2_diag = substr($opday2_diag,1);
		}
		if($cDiag != "")
			$list_diag = ", ";
		else
			$list_diag = "";

		if($toborow == "EX 91" || ($toborow2 == "EX91" ||  $toborow2 == "EX17")){
			$head_diag_ex91 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">โรค (จากกายภาพ/นวดแผนไทย)</FONT>";
			$detail_diag_ex91 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">".$opday2_diag."</FONT>";
			$list_diag .= $opday2_diag;
		}else if($toborow == "EX 92" || $toborow2 == "EX92"){
			$head_diag_ex92 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">โรค (จากฝังเข็ม)</FONT>";
			$detail_diag_ex92 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">".$opday2_diag."</FONT>";
			$list_diag .= $opday2_diag;
		}

	}

                  }  
   else {
      echo "ไม่พบ รหัส : $cTdatehn";
           }    


print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='dxopok.php' >";
print "<p><a href=javascript:history.back(1)><<< BACK</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "แก้ไขได้เฉพาะประเภทบุคคล กลุ่มโรค คลีนิก แพทย์ และรหัสICD10,ICD9CM</p>";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่    $cthidate </p>";

?>

<?php print "<p><input type='text' name='cokopd' size='2' value='$cokopd'>";?>
<TABLE border="0" align="center" width="80%">
<TR>
	<TD width="10%" >HN&nbsp;&nbsp;</TD>
	<TD width="19%" ><?php echo "<input type='text' name='hn' size='10' value='$cHn'>";?></TD>
	<TD width="15%" >ชื่อผู้ป่วย</TD>
	<TD width="20%" ><?php echo "<input type='text' name='ptname' size='30' value='$cPtname'>";?></TD>
	<TD width="17%" >ประเภทบุคคล</TD>
	<TD width="19%" ><?php
					print " <select  name='goup'>";
					print " <option value='$cGoup' selected>$cGoup</option>";
					print " <option value='0' ><-เลือกประเภทบุคค-></option>";
					print " <option value='G11&nbsp;ก.1 นายทหารประจำการ'>G11&nbsp;ก.1 นายทหารประจำการ</option>";
					print " <option value='G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ'>G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ</option>";
					print " <option value='G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน'>G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน</option>";
					print " <option value='G14&nbsp;ก.4 ลูกจ้างประจำ'>G14&nbsp;ก.4 ลูกจ้างประจำ</option>";
					print " <option value='G15 &nbsp;ก.5 ลูกจ้างชั่วคราว'>G15 &nbsp;ก.5 ลูกจ้างชั่วคราว</option>";
					print " <option value='G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ'>G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ</option>";
					print " <option value='G22&nbsp;ข.2 นักเรียนทหาร'>G22&nbsp;ข.2 นักเรียนทหาร</option>";
					print " <option value='G23 &nbsp;ข.3 อาสาสมัครทหารพราน'>G23 &nbsp;ข.3 อาสาสมัครทหารพราน</option>";
					print " <option value='G24 &nbsp;ข.4 นักโทษทหาร'>G24 &nbsp;ข.4 นักโทษทหาร</option>";
					print " <option value='G31&nbsp;ค.1 ครอบครัวทหาร'>G31&nbsp;ค.1 ครอบครัวทหาร</option>";
					print " <option value='G32&nbsp;ค.2 ทหารนอกประจำการ'>G32&nbsp;ค.2 ทหารนอกประจำการ</option>";
					print " <option value='G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)'>G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)</option>";
					print " <option value='G34&nbsp;ค.4 วิวัฒน์พลเมือง'>G34&nbsp;ค.4 วิวัฒน์พลเมือง</option>";
					print " <option value='G35&nbsp;ค.5 บัตรประกันสังคม'>G35&nbsp;ค.5 บัตรประกันสังคม</option>";
					print " <option value='G36&nbsp;ค.6 บัตรทอง30บาท'>G36&nbsp;ค.6 บัตรทอง30บาท</option>";
					print " <option value='G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)'>G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</option>";
					print " <option value='G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)'>G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</option>";
					print " <option value='G39&nbsp;ค.9 อื่นๆไม่ระบุ'>G39&nbsp;ค.9 อื่นๆไม่ระบุ</option>";
					print "   </select>";
				?></TD>
  </TR>
<TR>
	<TD >คลีนิก</TD>
	<TD >
	<?php
						/*
						print " <select  name='clinic' >";
						print " <option value='$Cclinic' selected>$Cclinic</option>";
						print " <option value='99' ><-เลือกคลีนิก-></option>";
						print " <option value='01 อายุรกรรม'>อายุรกรรม</option>";
						print " <option value='02 ศัลยกรรม'>ศัลยกรรม</option>";
						print " <option value='03 สูติกรรม'>สูติกรรม</option>";
						print " <option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>";
						print " <option value='05 กุมารเวช'>กุมารเวช</option>";
						print " <option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>";
						print " <option value='07 จักษุ'>จักษุ</option>";
						print " <option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>";
						print " <option value='09 จิตเวช'>จิตเวช</option>";
						print " <option value='10 รังษีวิทยา'>รังษีวิทยา</option>";
						print " <option value='11 ทันตกรรม'>ทันตกรรม</option>";
						print " <option value='12 ฉุกเฉิน'>ฉุกเฉิน</option>";
						print " <option value='13 กายภาพบำบัด'>กายภาพบำบัด</option>";
						print " <option value='14 แพทย์แผนไทย'>แพทย์แผนไทย</option>";
						print " <option value='15 PCU ใน รพ.'>PCU ใน รพ.</option>";
						print " <option value='99 อื่นๆ'>อื่นๆ</option>";
						print "   </select>";
					 */
			?>
			<select name="clinic" id="">
			<?php 
			$q = mysql_query("SELECT * FROM `clinic` ") or die( mysql_error() );
			while ($clin = mysql_fetch_assoc($q)) { 

				$selected = ( $Cclinic == $clin['detail'] ) ? 'selected="selected"' : '' ;

				?>
					<option value="<?=$clin['detail'];?>" <?=$selected;?> ><?=$clin['detail'];?></option>
				<?php
			}
			?>
			</select>
	</TD>
	<TD>แพทย์</TD>
	<TD><?php
						print "<select  name='doctor1'>";
						print " <option value='$cDoctor' selected>$cDoctor</option>";
						$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
						$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
						while($objResult = mysql_fetch_array($objQuery)) 
						{ 
							echo "<option value='".$objResult["name"]."'>".$objResult["name"]."</option> ";
						} 
						print "   </select>";
						?></TD>
                        <TD>ออก opcard โดย</TD>
                        <TD><strong>
                        <?=$ctoborow;?>
                        </strong></TD>
</TR>
<?
$date=explode(" ",$cthidate);
$date1=$date[0];
$sqlxray="select * from xray_stat where date like '$date1%' and hn='$cHn' ";
$objxray = mysql_query($sqlxray) or die ("Error Query [".$sqlxray."]");
$row_xray=mysql_num_rows($objxray);

if($row_xray){
?>
<TR>
  <TD colspan="6" align="center" >การตรวจ Xray</TD>
  </TR>
  <?
  while($arr=mysql_fetch_array($objxray)){
	  	$query2 = "SELECT * FROM depart WHERE date = '".$arr['date']."' ";
    	$result2 = mysql_query($query2);
		$arr2=mysql_fetch_array($result2);
   ?>
<TR>
  <TD colspan="2" align="center" >&nbsp;</TD>
  <TD colspan="2" ><a target="_blank" href="printcscd1.php?sDate=<?=$cthidate?>&nRow_id=<?=$arr2['row_id']?>"><?=$arr['detail'];?></TD>
  <TD align="left" >&nbsp;</TD>
  <TD align="left" >&nbsp;</TD>
  </TR>
<?
  }  //close while
}else{  //ถ้าไม่มี order xray ในตาราง xray_stat	
?>
<TR>
  <TD colspan="6" align="center" >การตรวจ Xray</TD>
  </TR>
  <?
	  	$query2 = "SELECT * FROM depart WHERE date like '$date1%' and hn='$cHn' and depart='xray' ";
		//echo $query2;
    	$result2 = mysql_query($query2);
		$arr2=mysql_fetch_array($result2);
   ?>
<TR>
  <TD colspan="2" align="center" >&nbsp;</TD>
  <TD colspan="2" ><a target="_blank" href="printcscd1.php?sDate=<?=$cthidate?>&nRow_id=<?=$arr2['row_id']?>"><?=$arr2['diag'];?></TD>
  <TD align="left" >&nbsp;</TD>
  <TD align="left" >&nbsp;</TD>
  </TR>
<?
}  //close if
?>
<tr>
  <td colspan="6" align="center"><div id="list" style="left:150px; top: 20px; position: absolute;"></div><b><br />
    : ICD10 (diagnosis) :</b></td>
</tr>

<?
	$test10="SELECT * FROM  patdata WHERE code like 'CHD%' and hn='$cHn' and date like '$date1%' and status='Y' and price > 0 ";

	$rows10= mysql_query($test10) or die("Query failed icd10"); 
	$rs10= mysql_num_rows($rows10);
if($rs10>0){
	?>
<tr>
  <td colspan="2" align="right">PRINCIPLE DX</td>
  <td colspan="4"><input type='text' name='icd10' size='8' id="icd10" onkeypress="searchSuggest3(this.value,3,'icd10','diag');" onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="N185"/>    <input name="diag" type="text" id="diag" size="40" value="Chronic kidney disease 5 D" onkeypress="searchSuggest3(this.value,3,'icd10','diag');"/>
  <input name="prin" type="hidden" value="" />
  <input name="thaiprin" type="hidden" value="ไตวายเรื้อรังระยะสุดท้าย"/></td>
</tr>
	<? //Chronic kidney disease 5 D
}else{
	$test1 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='PRINCIPLE' and an='".$_GET["cVn"]."' and status='Y' order by row_id desc ";

	$rows = mysql_query($test1);
	$rs = mysql_fetch_array($rows);
	?>
	<tr>
	  <td colspan="2" align="right">PRINCIPLE DX</td>
	  <td colspan="4"><input type='text' name='icd10' size='8' id="icd10" onkeypress="searchSuggest3(this.value,3,'icd10','diag');" onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="<?=$rs['icd10']?>"/>    <input name="diag" type="text" id="diag" size="40" value="<?=$rs['diag']?>" onkeypress="searchSuggest3(this.value,3,'icd10','diag');"/>
	  <input name="prin" type="hidden" value="<?=$rs['row_id']?>" />
	  <input name="thaiprin" type="hidden" value="<?=$rs['diag_thai']?>"/></td>
	</tr>
<?
}
?>
<tr>
  <td colspan="9"><hr /></td>
</tr>
<tr>
  <td colspan="9" align="center"></td>
</tr>
<tr>
  <td colspan="6">&nbsp;</td>
</tr>

<tr>
  <td colspan="6" align="right"><table width="100%">
    <?
  $r=0;
  $test4 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='OTHER' and an='".$_GET["cVn"]."' and status='Y'";
  $rows4 = mysql_query($test4);
  while($rs4 = mysql_fetch_array($rows4)){
  ?>
    <tr>
      <td width="21%"  align="right" valign="middle">OTHER</td>
      <td width="9%"  valign="middle"><input name="dt_icd10_othera<?=$r?>" type="text" id="dt_icd10_othera<?=$r?>" onkeypress="searchSuggest8(this.value,2,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" value="<?=$rs4['icd10']?>" /></td>
      <td width="70%"  valign="middle"><input name="dt_diag_othera<?=$r?>" type="text" id="dt_diag_othera<?=$r?>" onkeypress="searchSuggest8(this.value,2,'<?=$r?>');" size="40" value="<?=$rs4['diag']?>" />
        <input name="other<?=$r?>" type="hidden" value="<?=$rs4['row_id']?>" />
        <input name="thaiother<?=$r?>" type="hidden" value="<?=$rs4['diag_thai']?>"/></td>
    </tr>
    <?
	$r++;
  }
  $r=0;
	?>
  </table>
    <table width="100%" id="tbExp4">
      <tr>
        <td width="21%"  align="right" valign="middle">OTHER</td>
        <td width="9%"  valign="middle"><input name="dt_icd10_other<?=$r?>" type="text" id="dt_icd10_other<?=$r?>"  onkeypress="searchSuggest1(this.value,2,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8"  /></td>
      <td width="70%"  valign="middle"><input name="dt_diag_other<?=$r?>" type="text" id="dt_diag_other<?=$r?>" onkeypress="searchSuggest1(this.value,2,'<?=$r?>');" size="40" />
        </tr>
    </table>
    <table border="0" align="center">
      <tr>
        <td><input type="button" name="input4" value="+ OTHER" onclick="addRow4();" /></td>
      </tr>
    </table></td>
  </tr>
<tr>
  <td colspan="8"><hr /></td>
</tr>
  <tr>
  <td colspan="6" align="right">
    <!--EXTERNAL CAUSE 
    <input type='text' name='extcause' size='8' value='<?=$rs5['icd10'];?>' onkeypress="searchSuggest3(this.value,3,'extcause','externadetail')" onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"/>    
    <input name="externadetail" type="text" id="externadetail" size="40" value='<?=$rs5['diag'];?>'/>-->
    <table width="100%">
      <?
  $r=0;
  $test5 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='EXTERNAL CAUSE' and an='".$_GET["cVn"]."' and status='Y'";
  $rows5 = mysql_query($test5);
  while($rs5 = mysql_fetch_array($rows5)){
  ?>
      <tr>
        <td width="21%"  align="right" valign="middle">EXTERNAL CAUSE</td>
        <td width="9%"  valign="middle"><input name="dt_icd10_externala<?=$r?>" type="text" id="dt_icd10_externala<?=$r?>" onkeypress="searchSuggest9(this.value,3,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" value="<?=$rs5['icd10']?>" /></td>
        <td width="70%"  valign="middle"><input name="dt_diag_externala<?=$r?>" type="text" id="dt_diag_externala<?=$r?>" onkeypress="searchSuggest9(this.value,2,'<?=$r?>');" size="40" value="<?=$rs5['diag']?>" />
        <input name="external<?=$r?>" type="hidden" value="<?=$rs5['row_id']?>" />
        <input name="thaiexternal<?=$r?>" type="hidden" value="<?=$rs5['diag_thai']?>"/></td>
        </tr>
      <?
	$r++;
  }
  $r=0;
	?>
    </table>
    <table width="100%" id="tbExp5">
      <tr>
        <td width="21%"  align="right" valign="middle">EXTERNAL CAUSE</td>
        <td width="9%"  valign="middle"><input name="dt_icd10_external<?=$r?>" type="text" id="dt_icd10_external<?=$r?>" onkeypress="searchSuggest5(this.value,3,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" /></td>
        <td width="70%"  valign="middle"><input name="dt_diag_external<?=$r?>" type="text" id="dt_diag_external<?=$r?>" onkeypress="searchSuggest5(this.value,2,'<?=$r?>');" size="40" /></td>
        </tr>
    </table>
    <table border="0" align="center">
      <tr>
        <td><input type="button" name="input5" value="+ EXTERNAL CAUSE" onclick="addRow5();" /></td>
      </tr>
    </table></td>
  </tr>
  <!--<TR>
	<TD align="right" >PRINCIPLE DX
	<?php //print $head_diag_ex91;
//print $head_diag_ex92;?></TD>
	<TD><?php //print "<input type='text' name='diag' size='30' value='$cDiag$list_diag'>";?></TD>
	<TD width="214" align="right" >รหัส ICD10 โรคหลัก</TD>
	<TD width="26"><?php //print "<input type='text' name='icd10' size='10' value='$cIcd10'>";?></TD>
</TR>
<TR>
	<TD align="right" >CO-MORBIDITY </TD>
	<TD><?php //print "<input type='text' name='diag_morbidity' size='30' value='$cDiag_morbidity'>";?></TD>
	<TD align="right" >รหัส ICD10 โรครอง</TD>
	<TD><?php //print "<input type='text' name='icd101' size='10' value='$cIcd101'>";?></TD>
</TR>
<TR>
	<TD align="right" >COMPLICATION </TD>
	<TD><?php //print "<input type='text' name='diag_complication' size='30' value='$cDiag_complication'>";?></TD>
	<TD align="right" >รหัส ICD10 โรคแทรก</TD>
	<TD><?php //print "<input type='text' name='icd10_complication' size='10' value='$cIcd10_complication'>";?></TD>
</TR>
<TR>
	<TD align="right" >OTHER </TD>
	<TD><?php //print "<input type='text' name='diag_other' size='30' value='$cDiag_other'>";?></TD>
	<TD align="right" >รหัส ICD10 โรคอื่นๆ</TD>
	<TD><?php //print "<input type='text' name='icd10_other' size='10' value='$cIcd10_other'>";?></TD>
</TR>
<TR>
	<TD align="right" >EXTERNAL CAUSE </TD>
	<TD><?php //print "<input type='text' name='diag_external' size='30' value='$CExternal_cause'>";?></TD>
	<TD align="right" >รหัส ICD10 สาเหตุภายนอก</TD>
	<TD><?php //print "<input type='text' name='icd10_external' size='10' value='$cIcd10_external_cause'>";?></TD>
</TR>-->
<TR>
	<TD colspan="6" align="center" ><?php //print "<input type='text' name='icd9cm' size='30' value='$cIcd9cm'>";?><hr />
	  <strong>ข้อมูลการทำหัตถการ :ICD9CM :</strong>

<?
$sql2 = "select *  from patdata where date like '$date1%' and  hn='$cHn' and price >0 and amount >0 and part='SURG'";
//echo $sql2."<br>";
$rowp = mysql_query($sql2);
$nump=mysql_num_rows($rowp);
if($nump >0){
	$i=0;
	while($rows=mysql_fetch_array($rowp)){
		$i++;
		echo "<div>รายการที่ [".$i."] รหัสหัตถการ : ".$rows["code"]." รายละเอียด : ".$rows["detail"]."</div>";
	}
}
?>      
	  <table width="100%" border="0">
	    <tr>
	      <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
	        <tr>
	          <td colspan="3" align="center"></td>
	          </tr>
	        <tr>
	          <td colspan="3" align="center"></td>
	          </tr>
	        <tr>
	          <td colspan="2"><!--******************************************* -->
<? 
$a=0;
$test6="SELECT * FROM  opicd9cm WHERE hn='$cHn' and svdate like '$date1%' and vn='".$_GET["cVn"]."' and status='Y' ";
$rows6= mysql_query($test6) or die("Query failed icd10"); 
$rs6= mysql_num_rows($rows6);
if($rs6>0){
?>
	<table width="100%">
<? 

	  while($rs6 = mysql_fetch_array($rows6)){
		  
	$text="select * from icd9cm where code='".$rs6['icd9cm']."'";
	$result7= mysql_query($text) or die("Query failed icd10/7"); 
	$rs7 = mysql_fetch_array($result7);
	
	?>
	              <tr>
	                <td width="29%"  align="right" valign="middle">ICD9CM:</td>
	                <td width="10%"  valign="middle"><input name="icd9cma<?=$a?>" type="text" id="icd9cma<?=$a?>" onkeypress="searchSuggest10(this.value,3,'<?=$a?>');" value="<?=$rs6['icd9cm']?>" size="8" onkeydown="if(event.keyCode == 40 &amp;&amp;document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }" /></td>
	                <td width="61%"  valign="middle"><input name="icd9cmdetaila<?=$a?>" type="text" id="icd9cmdetaila<?=$a?>" size="40" value="<?=$rs7['detail']?>" />
                    <input name="icd9<?=$a?>" type="hidden" value="<?=$rs6['row_id']?>" /></td>
	                </tr>
	              <?
	$a++;
	 }?>
     </table>
     
<? 
	$a=0;
}else{
	$b=0;
	$test8="SELECT * FROM  patdata WHERE detail like '123456' and hn='$cHn' and date like '$date1%' and status='Y' and price > 0 ";
	$rows8= mysql_query($test8) or die("Query failed icd10"); 
	$rs8= mysql_num_rows($rows8);
	if($rs8>0){
	?>
	<table width="100%">
	<tr>
	<td width="29%"  align="right" valign="middle">ICD9CM:</td>
	<td width="10%"  valign="middle"><input name="icd9cmb<?=$b;?>" type="text" id="icd9cmb<?=$b;?>" onkeypress="searchSuggest4(this.value,3,'<?=$b;?>');" size="8" onkeydown="if(event.keyCode == 40 &amp;&amp;document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }" value=""  /></td>
	<td width="61%"  valign="middle"><input name="icd9cmdetailb<?=$b;?>" type="text" id="icd9cmdetailb<?=$b;?>" size="40" value="" /></td>
	</tr>
    <? $b++;?>
	<tr>
	<td width="29%"  align="right" valign="middle">ICD9CM:</td>
	<td width="10%"  valign="middle"><input name="icd9cmb<?=$b;?>" type="text" id="icd9cmb<?=$b;?>" onkeypress="searchSuggest4(this.value,3,'<?=$b;?>');" size="8" onkeydown="if(event.keyCode == 40 &amp;&amp;document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }" value=""  /></td>
	<td width="61%"  valign="middle"><input name="icd9cmdetailb<?=$b;?>" type="text" id="icd9cmdetailb<?=$b;?>" size="40" value="" /></td>
	</tr>
	<?
		$b++;
	}
	
	$test9="SELECT * FROM  patdata WHERE code like 'CHD%' and hn='$cHn' and date like '$date1%' and status='Y' and price > 0 ";
	$rows9= mysql_query($test9) or die("Query failed icd10"); 
	$rs9= mysql_num_rows($rows9);
	if($rs9>0){
		
	?>
	<table width="100%">
	<tr>
	<td width="29%"  align="right" valign="middle">ICD9CM:</td>
	<td width="10%"  valign="middle"><input name="icd9cmb<?=$b;?>" type="text" id="icd9cmb<?=$b;?>" onkeypress="searchSuggest4(this.value,3,'<?=$b;?>');" size="8" onkeydown="if(event.keyCode == 40 &amp;&amp;document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }" value="3995"  /></td>
	<td width="61%"  valign="middle"><input name="icd9cmdetailb<?=$b;?>" type="text" id="icd9cmdetailb<?=$b;?>" size="40" value="Hemodialysis" /></td>
	</tr>	
	<? //3995 Hemodialysis
		$b++;
	}
}
?>
</table>

	            
	           
	            <!--******************************************* -->
	            <table width="100%" id="tbExp2">
	              <tr>
	                <td width="29%"  align="right" valign="middle">ICD9CM</td>
	                <td width="10%"  valign="middle"><div id="list1" style="left: 202px; top: 300px; position: absolute;"></div>
	                  <input name="icd9cm<?=$a;?>" type="text" id="icd9cm<?=$a;?>" onkeypress="searchSuggest4(this.value,3,'<?=$a;?>');" size="8" onkeydown="if(event.keyCode == 40 &amp;&amp;document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }"  /></td>
	                <td width="61%"  valign="middle"><input name="icd9cmdetail<?=$a;?>" type="text" id="icd9cmdetail<?=$a;?>" size="40" /></td>
	                </tr>
	              </table></td>
	          </tr>
	        </table>
	        <table  width="70%" border="0" align="center">
	          <tr>
	            <td align="center"><p>
	              <input type="button" name="input2" value="+ ICD9CM" onclick="addRow2();" />
	            </p>
                <p>&nbsp; </p></td>
              </tr>
            </table></td>
        </tr>
    </table></TD>
  </TR>
</TABLE>
<?php
print "<CENTER><input type='submit' value='      &#3605;&#3585;&#3621;&#3591;      ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "<INPUT TYPE=\"hidden\" Name=\"Tdate\" Value=\"".$sTdatehn."\">";
print "<INPUT TYPE=\"hidden\" Name=\"cTdate\" Value=\"".$cTdate."\">";//วันที่มารับบริการกับเวลาที่ลงข้อมูล
print "<INPUT TYPE=\"hidden\" Name=\"cVn\" Value=\"".$_GET["cVn"]."\"></CENTER>";
print "</form>";


print "</body>";
include("unconnect.inc");
?>

    