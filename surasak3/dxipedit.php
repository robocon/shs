<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
    include("connect.inc");

    $query = "SELECT * FROM ipcard WHERE an = '$cAn'";
    $result = mysql_query($query) or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   if($result){
	  $cDate=$row->date;	
        $cHn=$row->hn;
        $cAn= $row->an;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
        $cGoup=$row->goup;
        $cCamp=$row->camp;
        $cDiag=$row->diag;
        $cIcd10=$row->icd10;
        $cComorbid=$row->comorbid;
        $cComplica=$row->complica;
	  	$cOther=$row->other;
 	 	$cExtcause=$row->extcause;
        $cIcd9=$row->icd9cm;
        $cSecond=$row->second;
        $cResult=$row->result;
	 	$cDctype=$row->dctype; 
        $cDoctor=$row->doctor;
		$cClinic = $row->clinic;
                  }  
   else {
      echo "ไม่พบ AN : $cAn";
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
//////////////////////////////////


if(isset($_GET["action"]) && $_GET["action"] == "searchicd10"){
	

	$sql = "Select * from  icd10   WHERE (code like '%".$_GET["search"]."%') OR (detail LIKE '%".$_GET["search"]."%')";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:500px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td><font style=\"color: #FFFFFF\"><strong>เลือก</strong></font></td>
				<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">Close</A></strong></font></td>
				
			</tr>";


		if(isset($_GET['num'])){
		
			$_GET["getto2"]="dt_diag_morbidity".$_GET['num'];
			$_GET["getto"]="dt_icd10_morbidity".$_GET['num'];
		}
		if(isset($_GET['num2'])){
			$_GET["getto2"]="comdetail".$_GET['num2'];
			$_GET["getto"]="complica".$_GET['num2'];
		}
		if(isset($_GET['num3'])){
			$_GET["getto2"]="otherdetail".$_GET['num3'];
			$_GET["getto"]="other".$_GET['num3'];
		}
		if(isset($_GET['num4'])){
			$_GET["getto2"]="externadetail".$_GET['num4'];
			$_GET["getto"]="extcause".$_GET['num4'];
		}
		
		
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
					
		
		/* <A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["detail"],"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A> */
		
			echo "<tr bgcolor=\"$bgcolor\" >
			<td><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">
</td>
					<td>",$arr["code"],"</td>
					<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".$arr["code"]."';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML ='';\">".$arr["detail"]."</A></td>
					
					

				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>";

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
	

	$sql = "Select * from  icd10   WHERE (code like '%".$_GET["search"]."%') OR (detail LIKE '%".$_GET["search"]."%')";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:500px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td><font style=\"color: #FFFFFF\"><strong>เลือก</strong></font></td>
				<td width=\"120\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">Close</A></strong></font></td>
				
			</tr>";


		if(isset($_GET['num'])){
		
			$_GET["getto2"]="dt_diag_morbidity".$_GET['num'];
			$_GET["getto"]="dt_icd10_morbidity".$_GET['num'];
		}
		if(isset($_GET['num2'])){
			$_GET["getto2"]="comdetail".$_GET['num2'];
			$_GET["getto"]="complica".$_GET['num2'];
		}
		if(isset($_GET['num3'])){
			$_GET["getto2"]="otherdetail".$_GET['num3'];
			$_GET["getto"]="other".$_GET['num3'];
		}
		if(isset($_GET['num4'])){
			$_GET["getto2"]="externadetail".$_GET['num4'];
			$_GET["getto"]="extcause".$_GET['num4'];
		}
		
		
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
					
		
		/* <A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["detail"],"';document.getElementById('list').innerHTML='';\">",$arr["detail"],"</A> */
		//ล๊อครหัส ที่ขึ้นต้นด้วย V,W,X,Y				
if (preg_match("/V/i", $arr["code"]) || preg_match("/W/i", $arr["code"]) || preg_match("/X/i", $arr["code"]) || preg_match("/Y/i", $arr["code"])) {
	
			echo "<tr bgcolor=\"$bgcolor\" >
			<td><INPUT id='choice' TYPE=\"radio\"  disabled='disabled' NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">
</td>
					<td>",$arr["code"],"</td>
					<td>$arr[detail]</td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>";
				
}else{
			echo "<tr bgcolor=\"$bgcolor\" >
			<td><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13){document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';}\" ondblclick=\"document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML='';\">
</td>
					<td>",$arr["code"],"</td>
					<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".$arr["code"]."';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML ='';\">".$arr["detail"]."</A></td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>";	
	
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

if(isset($_GET["action"]) && $_GET["action"] == "searchicd9cm"){
	
	$sql = "Select code,detail From icd9cm where (code like '%".$_GET["search2"]."%' OR detail LIKE '%".$_GET["search2"]."%' )";
	$result = mysql_query($sql);

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width='100%'>
		<TR>
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
			
		
			echo "<tr bgcolor=\"$bgcolor\" >
					
					<td><INPUT id='choice2' TYPE=\"radio\" NAME=\"choice2\"  onkeypress=\"if(event.keyCode==13){ document.getElementById('".$getto."').value = '".$arr["code"]."';document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';document.getElementById('list1').innerHTML =''; } \" ondblclick=\"document.getElementById('".$getto."').value = '".$arr["code"]."';document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';document.getElementById('list1').innerHTML ='';\"></td>
					
					<td>".$arr["code"]."</td>
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$getto."').value = '".$arr["code"]."';document.getElementById('".$getto2."').value = '",jschars($arr["detail"]),"';document.getElementById('list1').innerHTML ='';\">".$arr["detail"]."</A></td>

				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>
			";

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
			url = 'dxipedit.php?action=searchicd10b&search=' + str+'&num=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}


function searchSuggest2(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxipedit.php?action=searchicd9cm&search2=' + str+'&num=' + number;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest3(str,len,getto,getto2) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxipedit.php?action=searchicd10b&search=' + str+'&getto=' + getto+'&getto2=' + getto2;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest4(str,len,getto,getto2) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dxipedit.php?action=searchicd9cm&search2=' + str+'&getto=' + getto+'&getto2=' + getto2;
			
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest5(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxipedit.php?action=searchicd10b&search=' + str+'&num2=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
function searchSuggest6(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxipedit.php?action=searchicd10&search=' + str+'&num3=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
function searchSuggest7(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dxipedit.php?action=searchicd10&search=' + str+'&num4=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
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
		cell0.innerHTML = 'CO-MORBIDITY:';
		cell1.innerHTML = '<input name="dt_icd10_morbidity'+(count_row)+'"  type="text" id="dt_icd10_morbidity'+(count_row)+'" onKeyPress="searchSuggest(this.value,3,'+(count_row)+');" size="8" onKeyDown="radiofocus()">';
		
		cell2.align= "right";
		cell2.innerHTML = '<input name="dt_diag_morbidity'+(count_row)+'"  type="text" id="dt_diag_morbidity'+(count_row)+'" onKeyPress="searchSuggest(this.value,3,'+(count_row)+');" size="40" onKeyDown="radiofocus()">';
		//cell3.innerHTML=  '&nbsp;';
	}
}



////////////////////////////////

function addRow2()
{ 
	var count_row2=document.getElementById('tbExp').rows.length ;
	if(count_row2<16){
		var _table = document.getElementById('tbExp').insertRow(count_row2);
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
		cell0.innerHTML = 'ICD9CM:';
		cell1.innerHTML = '<input name="icd9cm'+(count_row2)+'"  type="text" id="icd9cm'+(count_row2)+'" size="8" onKeyPress="searchSuggest2(this.value,3,'+(count_row2)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="icd9cmdetail'+(count_row2)+'"  type="text" id="icd9cmdetail'+(count_row2)+'"  size="40">';
		cell3.innerHTML = 'วันที่:';
		cell4.innerHTML = '<input name="icddate'+(count_row2)+'"  type="text" id="icddate'+(count_row2)+'"  size="20">';
		//cell6.innerHTML=  '&nbsp;';
	}
}


////////////// 3 /////////////////////////


function addRow3()
{ 
	var count_row3=document.getElementById('tbExp2').rows.length ;
	if(count_row3<16){
		var _table = document.getElementById('tbExp2').insertRow(count_row3);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2);

		var getto = "complica"+count_row3;
		var getto2 = "comdetail"+count_row3;
		
		cell0.align= "right";
		cell0.innerHTML = 'COMPLICATION:';
		cell1.innerHTML = '<input name="complica'+(count_row3)+'"  type="text" id="complica'+(count_row3)+'" size="8" onKeyPress="searchSuggest5(this.value,3,'+(count_row3)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="comdetail'+(count_row3)+'"  type="text" id="comdetail'+(count_row3)+'"  onKeyPress="searchSuggest5(this.value,3,'+(count_row3)+')" onKeyDown="radiofocus();" size="40">';
		//cell6.innerHTML=  '&nbsp;';
	}
}


////////////////////////////////////////

////////////// 3 /////////////////////////


function addRow4()
{ 
	var count_row4=document.getElementById('tbExp3').rows.length ;
	if(count_row4<16){
		var _table = document.getElementById('tbExp3').insertRow(count_row4);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2);

		var getto = "other"+count_row4;
		var getto2 = "otherdetail"+count_row4;
		
		cell0.align= "right";
		cell0.innerHTML = 'OTHER:';
		cell1.innerHTML = '<input name="other'+(count_row4)+'"  type="text" id="other'+(count_row4)+'" size="8" onKeyPress="searchSuggest6(this.value,3,'+(count_row4)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="otherdetail'+(count_row4)+'"  type="text" id="otherdetail'+(count_row4)+'"  size="40" onKeyPress="searchSuggest6(this.value,3,'+(count_row4)+')" onKeyDown="radiofocus();">';
		//cell6.innerHTML=  '&nbsp;';
	}
}


////////////// 4 /////////////////////////


function addRow5()
{ 
	var count_row5=document.getElementById('tbExp4').rows.length ;
	if(count_row5<16){
		var _table = document.getElementById('tbExp4').insertRow(count_row5);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2);

		var getto = "extcause"+count_row5;
		var getto2 = "externadetail"+count_row5;
		
		cell0.align= "right";
		cell0.innerHTML = 'EXTERNAL CAUSE:';
		cell1.innerHTML = '<input name="extcause'+(count_row5)+'"  type="text" id="extcause'+(count_row5)+'" size="8" onKeyPress="searchSuggest7(this.value,3,'+(count_row5)+')" onKeyDown="radiofocus();">';
		cell2.innerHTML = '<input name="externadetail'+(count_row5)+'"  type="text" id="externadetail'+(count_row5)+'"  size="40" onKeyPress="searchSuggest7(this.value,3,'+(count_row5)+')" onKeyDown="radiofocus();">';
		//cell6.innerHTML=  '&nbsp;';
	}
}
</script>

<style type="text/css">
.font3 {	font-size: 20px;
}
</style>
<body bgcolor='#008080'>

<!--action='dxipok.php'-->
<form method='POST'  action='dxipok.php'>

<h4 align="center">แก้ไขได้เฉพาะ  ประเภทบุคคล  สังกัดหน่วย  รหัส ICD ผลการรักษา และสถานภาพจำหน่าย เท่านั้น</h4>

<br />
  <a target=_self  href='../nindex.htm' style="color:#FFF"> ไปเมนู</a>
<br />
<br />
<center>
  <fieldset>
<legend>ข้อมูลผู้ป่วย</legend>
<table  border="0" align="center">
  <tr>
    <td align="right">ADMIT:</td>
    <td><input type='text' name='admdate' size='20' value='<?=$cDate;?>' /></td>
    <td>HN</td>
    <td><input type='text' name='hn' size='20' value='<?=$cHn;?>' id="hn" /></td>
    <td>AN</td>
    <td><input type='text' name='an' size='20' value='<?=$cAn;?>' /></td>
  </tr>
  <tr>
    <td align="right">ชื่อผู้ป่วย</td>
    <td><input type='text' name='ptname' size='20' value='<?=$cPtname;?>' /></td>
    <td>สิทธิการรักษา</td>
    <td><input type='text' name='ptright' size='20' value='<?=$cPtright;?>' /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">ประเภทบุคคล</td>
    <td colspan="2"><select  name='goup'>
      <option value='<?=$cGoup;?>' selected>
        <?=$cGoup;?>
        </option>
      <option value='0' ><-เลือกประเภทบุคค-></option>
      <option value='G11&nbsp;ก.1 นายทหารประจำการ'>G11&nbsp;ก.1 นายทหารประจำการ</option>
      <option value='G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ'>G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ</option>
      <option value='G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน'>G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน</option>
      <option value='G14&nbsp;ก.4 ลูกจ้างประจำ'>G14&nbsp;ก.4 ลูกจ้างประจำ</option>
      <option value='G15 &nbsp;ก.5 ลูกจ้างชั่วคราว'>G15 &nbsp;ก.5 ลูกจ้างชั่วคราว</option>
      <option value='G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ'>G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ</option>
      <option value='G22&nbsp;ข.2 นักเรียนทหาร'>G22&nbsp;ข.2 นักเรียนทหาร</option>
      <option value='G23 &nbsp;ข.3 อาสาสมัครทหารพราน'>G23 &nbsp;ข.3 อาสาสมัครทหารพราน</option>
      <option value='G24 &nbsp;ข.4 นักโทษทหาร'>G24 &nbsp;ข.4 นักโทษทหาร</option>
      <option value='G31&nbsp;ค.1 ครอบครัวทหาร'>G31&nbsp;ค.1 ครอบครัวทหาร</option>
      <option value='G32&nbsp;ค.2 ทหารนอกประจำการ'>G32&nbsp;ค.2 ทหารนอกประจำการ</option>
      <option value='G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)'>G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)</option>
      <option value='G34&nbsp;ค.4 วิวัฒน์พลเมือง'>G34&nbsp;ค.4 วิวัฒน์พลเมือง</option>
      <option value='G35&nbsp;ค.5 บัตรประกันสังคม'>G35&nbsp;ค.5 บัตรประกันสังคม</option>
      <option value='G36&nbsp;ค.6 บัตรทอง30บาท'>G36&nbsp;ค.6 บัตรทอง30บาท</option>
      <option value='G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)'>G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</option>
      <option value='G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)'>G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</option>
      <option value='G39&nbsp;ค.9 อื่นๆไม่ระบุ'>G39&nbsp;ค.9 อื่นๆไม่ระบุ</option>
    </select></td>
    <td>สังกัดหน่วย</td>
    <td colspan="2"><select  name='camp'>
      <option value='<?=$cCamp;?>'> </option>
      <option value='<?=$cCamp;?>' selected>
        <?=$cCamp;?>
        </option>
      <option value='0' ><-เลือกสังกัด-></option>
      <option value='M01&nbsp; พลเรือน' >M01&nbsp; พลเรือน</option>
      <option value='M02&nbsp; ร.17 พัน2' >M02&nbsp; ร.17 พัน2</option>
      <option value='M03&nbsp; มณฑลทหารบกที่32' >M03&nbsp; มณฑลทหารบกที่32</option>
      <option value='M04&nbsp; ร.พ.ค่ายสุรศักดิมนตรี' >M04&nbsp; ร.พ.ค่ายสุรศักดิมนตรี</option>
      <option value='M05&nbsp; ช.พัน4' >M05&nbsp; ช.พัน4</option>
      <option value='M06&nbsp;ร้อยฝึกรบพิเศษประตูผา' >M06&nbsp;ร้อยฝึกรบพิเศษประตูผา</option>
      <option value='M07&nbsp; หน่วยทหารอื่นๆ' >M07&nbsp; หน่วยทหารอื่นๆ</option>
    </select></td>
    </tr>
  <tr>
    <td align="right">วินิจฉัยโรค</td>
    <td><input type='text' name='diag' size='20' value='<?=$cDiag;?>' /></td>
    <td>คลีนิก</td>
    <td><select  name='clinic'>
      <option value='<?=$cClinic;?>' selected>
        <?=$cClinic;?>
        </option>
      <option value='00' >--เลือกคลีนิก--</option>
      <option value='01 อายุรกรรม'>อายุรกรรม</option>
      <option value='02 ศัลยกรรม'>ศัลยกรรม</option>
      <option value='03 สูติกรรม'>สูติกรรม</option>
      <option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>
      <option value='05 กุมารเวช'>กุมารเวช</option>
      <option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>
      <option value='07 จักษุ'>จักษุ</option>
      <option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>
      <option value='09 จิตเวช'>จิตเวช</option>
      <option value='10 รังษีวิทยา'>รังษีวิทยา</option>
      <option value='11 ทันตกรรม'>ทันตกรรม</option>
      <option value='12 อื่นๆ'>อื่นๆ</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</fieldset>

<br />
<br />
 <?  
 $stricd10="SELECT * FROM diag WHERE an='$cAn' and type='PRINCIPLE'"; 
 $resulticd10 = mysql_query($stricd10) or die("Query failed icd10");
 $rs = mysql_fetch_array($resulticd10);
 
 $seicd10="select detail from icd10 where code='".$rs['icd10']."' ";
 $seresult = mysql_query($seicd10) or die("Query failed 1");
 $sers = mysql_fetch_array($seresult);
 

 ?>    

<fieldset>

<legend>ICD10</legend>
  <table border='0' align="center" cellpadding='2' cellspacing='0'  width="100%">
      <tr>
		  <td valign='top'>
          
          <!--- ///////////////////////////////////////////-->

          <table  border="0" align="center">
            <tr>
              <td rowspan="13" align="center" valign="top">
              
              <table border="0" align="left" >
                <tr>
                  <td colspan="2" align="center" valign="top">ข้อมูลเก่า ipcard</td>
                  <td width="13" rowspan="11" align="center" valign="top" style="border-left-style:dotted; border-left-width:1px">&nbsp;</td>
                  </tr>
                <tr>
                  <td width="78" >icd10-</td>
                  <td width="6"  align="left"><?=$cIcd10;?></td>
                  </tr>
                <tr>
                  <td>comorbid-</td>
                  <td align="left"><?=$cComorbid;?></td>
                  </tr>
                <tr>
                  <td>complica
                    &nbsp;-</td>
                  <td align="left"><?=$cComplica;?></td>
                  </tr>
                <tr>
                  <td>other
                    &nbsp;-</td>
                  <td align="left"><?=$cOther;?></td>
                  </tr>
                <tr>
                  <td>extcause-</td>
                  <td align="left"><?=$cExtcause;?></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  </tr>
              </table></td>
              <td colspan="4" align="center"><b>ICD10 (diagnosis)</b></td>
              </tr>
            <tr>
              <td>PRINCIPLE DX</td>
              <td><input type='text' name='icd10' size='8' value='<?=$rs['icd10'];?>'   id="icd10" onKeyPress="searchSuggest3(this.value,3,'icd10','icd10detail')" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"/></td>
              <td><input name="icd10detail" type="text" id="icd10detail" size="40" value="<?=$sers['detail'];?>" onKeyPress="searchSuggest3(this.value,3,'icd10','icd10detail')" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"/>
                <input type="hidden" name="dx1" value="<?=$rs['row_id'];?>"></td>
          
              </tr>
            <tr>
              <td colspan="4"><hr></td>
            </tr>
            <tr>
   <td colspan="4"> 
     
     <!--********************************-->
     
     
     <table  width="100%">
       <?  
 $str2="SELECT * FROM diag WHERE an='$cAn' and type='CO-MORBIDITY'"; 
 $result2= mysql_query($str2) or die("Query failed icd10");
	 
	$i=1;
	 while($rs2 = mysql_fetch_array($result2)){ 
	 
	 //echo $rs2['row_id']."<br>";
	 
 $seicd101="select detail from icd10 where code='".$rs2['icd10']."' ";
 $seresult1 = mysql_query($seicd101) or die("Query failed 1");
 $sers1 = mysql_fetch_array($seresult1);
	 
	 ?>
       <TR>
         <TD  align="right" valign="middle">CO-MORBIDITY:</TD>
         <TD  valign="middle">
           <input name="dt_icd10_<?=$i;?>" type="text" id="dt_icd10_<?=$i;?>" onKeyPress="searchSuggest3(this.value,3,'dt_icd10_<?=$i;?>','dt_diag_<?=$i;?>');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="<?=$rs2['icd10']?>" size="8"  ></TD>
         <TD  valign="middle"><input name="dt_diag_<?=$i;?>" type="text" id="dt_diag_<?=$i;?>" value="<?=$sers1['detail']?>" onKeyPress="searchSuggest3(this.value,3,'dt_icd10_<?=$i;?>','dt_diag_<?=$i;?>');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle">
         <input type="hidden" name="dx2<?=$i;?>" value="<?=$rs2['row_id'];?>" id="dx2<?=$i;?>">
           </TD>
         </TR>
       <? 
	  $i++;
	  } ?>
         
       </table>
          <input type="hidden" name="max" value="<?=$i;?>">
     <!--********************************--> 
     
     <table id="tbExp1" width="100%">
       <tr>
         <TD  align="right" valign="middle">CO-MORBIDITY:</TD>
         <TD  valign="middle">
           <Div id="list" style="left:200PX;top:70PX;position:absolute;"></Div>
           <input name="dt_icd10_morbidity0" type="text" id="dt_icd10_morbidity0" onKeyPress="searchSuggest(this.value,3,'0');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="" size="8" ></TD>
         <TD  valign="middle"><input name="dt_diag_morbidity0" type="text" id="dt_diag_morbidity0"  onKeyPress="searchSuggest(this.value,3,'0');"  onKeyDown="if(event.keyCode ==40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40" value=""></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle">
  </TD>
         </tr>
       </table>
  
     <table border="0" align="center">
       <tr>
         <td>
           <input type="button" name="input" value="+ CO-MORBIDITY" onClick="addRow();" ></td>
         </tr>
   </table></td>
  </tr>              
                
            <tr>
            <td colspan="4"><hr></td>
              </tr>
<tr>
	<td colspan="3"> 
    
    <table  width="100%">
       <?  
 $str3="SELECT * FROM diag WHERE an='$cAn' and type='COMPLICATION'"; 
 $result3= mysql_query($str3) or die("Query failed icd10");
	 
	$b=1;
	 while($rs3 = mysql_fetch_array($result3)){ 
	 
	 
	  $seicd102="select detail from icd10 where code='".$rs3['icd10']."' ";
 $seresult2 = mysql_query($seicd102) or die("Query failed 2");
 $sers2 = mysql_fetch_array($seresult2);
	 ?>
       <TR>
         <TD  align="right" valign="middle">COMPLICATION:</TD>
         <TD  valign="middle">
           <input name="complica_<?=$b;?>" type="text" id="complica_<?=$b;?>" onKeyPress="searchSuggest3(this.value,3,'complica_<?=$b;?>','comdetail_<?=$b;?>');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="<?=$rs3['icd10']?>" size="8"  ></TD>
         <TD  valign="middle"><input name="comdetail_<?=$b;?>" type="text" id="comdetail_<?=$b;?>" value="<?=$sers2['detail']?>" onKeyPress="searchSuggest3(this.value,3,'complica_<?=$b;?>','comdetail_<?=$b;?>');" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle"><input type="hidden" name="dx3<?=$b;?>" value="<?=$rs3['row_id'];?>">
           </TD>
         </TR>
       <? 
	  $b++;
	  } 
	  ?>
       <input type="hidden" name="c1" value="<?=$b;?>">
       </table>  
    <table id="tbExp2" width="100%">
       <tr>
         <TD  align="right" valign="middle">COMPLICATION:</TD>
         <TD  valign="middle">
           <Div id="list" style="left:200PX;top:70PX;position:absolute;"></Div>
           <input name="complica0" type="text" id="complica0" onKeyPress="searchSuggest5(this.value,3,'0');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="" size="8" ></TD>
         <TD  valign="middle"><input name="comdetail0" type="text" id="comdetail0" value="" onKeyPress="searchSuggest5(this.value,3,'0');" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle">
  </TD>
         </tr>
       </table>
       
       
       <table border="0" align="center">
       <tr>
         <td>
           <input type="button" name="input" value="+ COMPLICATION" onClick="addRow3();" ></td>
         </tr>
     </table>
       </td>
              </tr>
<tr>
  <td colspan="3"><hr></td>
</tr>
            <tr>
              <td colspan="3">
              
<table  width="100%">
       <?  
 $str4="SELECT * FROM diag WHERE an='$cAn' and type='OTHER'"; 
 $result4= mysql_query($str4) or die("Query failed icd10");
	 
	$c=1;
	 while($rs4 = mysql_fetch_array($result4)){ 
	 
	 
	   $seicd103="select detail from icd10 where code='".$rs4['icd10']."' ";
 $seresult3 = mysql_query($seicd103) or die("Query failed 3");
 $sers3 = mysql_fetch_array($seresult3);
	 ?>
       <TR>
         <TD  align="right" valign="middle">OTHER:</TD>
         <TD  valign="middle">
           <input name="other_<?=$c;?>" type="text" id="other_<?=$c;?>" onKeyPress="searchSuggest3(this.value,3,'other_<?=$c;?>','otherdetail_<?=$c;?>');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="<?=$rs4['icd10']?>" size="8"  ></TD>
         <TD  valign="middle"><input name="otherdetail_<?=$c;?>" type="text" id="otherdetail_<?=$c;?>" value="<?=$sers3['detail']?>" onKeyPress="searchSuggest3(this.value,3,'other_<?=$c;?>','otherdetail_<?=$c;?>');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle"><input type="hidden" name="dx4<?=$c;?>" value="<?=$rs4['row_id'];?>">
           </TD>
         </TR>
       <? 
	  $c++;
	  } ?>
      <input type="hidden" name="ot" value="<?=$c;?>">
       </table>
        <table id="tbExp3" width="100%">
       <tr>
         <TD  align="right" valign="middle">OTHER:</TD>
         <TD  valign="middle">
           
           <input name="other0" type="text" id="other0" onKeyPress="searchSuggest6(this.value,3,'0');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="" size="8" ></TD>
         <TD  valign="middle"><input name="otherdetail0" type="text" id="otherdetail0" value="" onKeyPress="searchSuggest6(this.value,3,'0');" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle">
  </TD>
         </tr>
       </table> 
        
        <table border="0" align="center">
       <tr>
         <td>
           <input type="button" name="input" value="+ OTHER" onClick="addRow4();" ></td>
         </tr>
     </table>
          
              </td>
              </tr>
            <tr>
              <td colspan="3"><hr></td>
            </tr>
         
            <tr>
              <td colspan="3">
              
              <table  width="100%">
       <?  
 $str5="SELECT * FROM diag WHERE an='$cAn' and type='EXTERNAL CAUSE'"; 
 $result5= mysql_query($str5) or die("Query failed icd10");
	 
	$d=1;
	 while($rs5 = mysql_fetch_array($result5)){ 
	 
	 
	  $seicd104="select detail from icd10 where code='".$rs5['icd10']."' ";
 $seresult4 = mysql_query($seicd104) or die("Query failed 3");
 $sers4 = mysql_fetch_array($seresult4);
	 ?>
       <TR>
         <TD  align="right" valign="middle">EXTERNAL CAUSE:</TD>
         <TD  valign="middle">
           <input name="extcause_<?=$d;?>" type="text" id="extcause_<?=$d;?>" onKeyPress="searchSuggest3(this.value,3,'extcause_<?=$d;?>','externadetail_<?=$d;?>');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="<?=$rs5['icd10']?>" size="8"  ></TD>
         <TD  valign="middle"><input name="externadetail_<?=$d;?>" type="text" id="externadetail_<?=$d;?>" value="<?=$sers4['detail']?>" onKeyPress="searchSuggest3(this.value,3,'extcause_<?=$d;?>','externadetail_<?=$d;?>');" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle"><input type="hidden" name="dx5<?=$d;?>" value="<?=$rs5['row_id'];?>">
           </TD>
         </TR>
       <? 
	  $d++;
	  } ?>
      <input type="hidden" name="ex" value="<?=$d;?>">
       </table>
          <table id="tbExp4" width="100%">
       <tr>
         <TD  align="right" valign="middle">EXTERNAL CAUSE:</TD>
         <TD  valign="middle">
        
           <input name="extcause0" type="text" id="extcause0" onKeyPress="searchSuggest7(this.value,3,'0');"  onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="" size="8" ></TD>
         <TD  valign="middle"><input name="externadetail0" type="text" id="externadetail0" value="" onKeyPress="searchSuggest7(this.value,3,'0');" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"size="40"></TD>
         </tr>
       <tr>
         <TD colspan="3"  align="center" valign="middle">
  </TD>
         </tr>
       </table> 
          
<table border="0" align="center">
  <tr>
         <td>
           <input type="button" name="input" value="+ EXTERNAL CAUSE" onClick="addRow5();" ></td>
         </tr>
   </table>
     
          
              </td>
              </tr>
          </table>
          <!--- ///////////////////////////////////////////-->
        </td>
        </tr>
    </table>
</fieldset>
<br />
<fieldset>
<legend>ICD9CM</legend>

<table width="70%" border="0">
  <tr>
    <td>
    
    
    <table border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
              <td colspan="3" align="center"></td>
              </tr>
            <tr>
              <td colspan="3" align="center">
</td>
            </tr>
    <tr>

      <td colspan="2">
 <!--******************************************* -->    
 <? 
$str6="SELECT * FROM  ipicd9cm WHERE an='$cAn'"; 
$result6= mysql_query($str6) or die("Query failed icd10/5"); 
?>  
      <table>
      <? 
	  $a=1;
	  while($rs6 = mysql_fetch_array($result6)){
		  
	$text="select * from icd9cm where code='".$rs6['icd9cm']."'";
	$result7= mysql_query($text) or die("Query failed icd10/7"); 
	$rs7 = mysql_fetch_array($result7);
	
	?>
    <TR>
      <TD  align="right" valign="middle">ICD9CM:</TD>
      <TD  valign="middle">
      
     
        <input name="icd9cm_<?=$a?>" type="text" id="icd9cm<?=$a?>" onKeyPress="searchSuggest4(this.value,3,'icd9cm_<?=$a?>','icd9cmdetail_<?=$a?>');" value="<?=$rs6['icd9cm']?>" size="8" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }"></TD>
      <TD  valign="middle"> <input name="icd9cmdetail_<?=$a?>" type="text" id="icd9cmdetail_<?=$a?>" size="40" value="<?=$rs7['detail']?>"></TD>
      <TD  valign="middle">วันที่:</TD>
      <TD  valign="middle"><input name="icddate_<?=$a?>" type="text" id="icddate_<?=$a?>" value="<?=$rs6['icddate']?>"  size="20">
      
      <input type="hidden" name="row<?=$a?>" value="<?=$rs6['row_id']?>">
      </TD>
    </tr>
    <?
	$a++;
	 }?>
  </table>
      <input type="hidden" name="maxicd9" value="<?=$a;?>"> 
    <!--******************************************* -->
  <table id="tbExp">
    <tr>
      <TD  align="right" valign="middle">ICD9CM:</TD>
      <TD  valign="middle">
      
        <Div id="list1" style="left: 202px; top: 263px; position: absolute;"></Div>
        <input name="icd9cm0" type="text" id="icd9cm0" onKeyPress="searchSuggest2(this.value,3,'0');" value="" size="8" onKeyDown="if(event.keyCode == 40 &&document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }"></TD>
      <TD  valign="middle"> <input name="icd9cmdetail0" type="text" id="icd9cmdetail0" size="40"></TD>
      <TD  valign="middle">วันที่:</TD>
      <TD  valign="middle"><input name="icddate0" type="text" id="icddate0" value=""  size="20"></TD>
    </tr>
    
  </table>
      
      
      </td>
      </tr>
 </table>
 
    <table  width="70%" border="0" align="center">
    <tr>
      <TD align="center"><hr></TD>
      </tr>
      <tr>
   <td align="center"><input type="button" name="input2" value="+ ICD9CM" onClick="addRow2();"></td>
      </tr>
    </table>
    
    
    </td>
  </tr>
</table>


</fieldset>
<br />
<fieldset>
<legend>ผลการรักษา</legend>
    <table width="70%" border='0' align="center" >
      <tr>
        <td width='24%' align="right">ผลการรักษา<br>
          <br></td>

  <td width='68%' valign='top'><select  name='result'>
   <OPTION value='<?=$cResult;?>'>
 <option value='<?=$cResult;?>' selected><?=$cResult;?></option>
  <option value='0' ><-เลือก-></option>
  <option value='1 Complete Recovery'>1 Complete Recovery</option>
  <option value='2 Improved'>2 Improved</option>
  <option value='3 Not Improved'>3 Not Improved</option>
    <option value='4 Normal Delivery'>4 Normal Delivery</option>
	  <option value='5 Un-delivery'>5 Un-delivery</option>
	    <option value='6 Normal Child D/C w mother'>6 Normal Child D/C w mother</option>
		  <option value='7 Normal Child D/C w separately'>7 Normal Child D/C w separately</option>
  <option value='8 Dead stillbrith'>8 Dead stillbrith</option>
    <option value='9 Dead'>9 Dead</option>

  </select>

 </td>
      </tr>
      <tr>
        <td align="right">สถานภาพจำหน่าย</td>
        <td valign='top'><select  name='dctype'>
          <option value='<?=$cDctype;?>'> </option>
          <option value='<?=$cDctype;?>' selected>
            <?=$cDctype;?>
          </option>
          <option value='0' ><-เลือก-></option>
          <option value='1 With Approval'>1 With Approval</option>
          <option value='2 Against Advice'>2 Against Advice</option>
          <option value='3 By escape'>3 By escape</option>
          <option value='4 By transfer'>4 By transfer</option>
          <option value='5 Other'>5 Other</option>
          <option value='8 Dead Autopsy'>8 Dead Autopsy</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">แพทย์</td>
        <td valign='top'><input type='text' name='doctor' size='30' value='<?=$cDoctor;?>' /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign='top'>&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign='top'><input type='submit' value='       ตกลง       ' name='B1' />
      </td>
      </tr>
    </table>
    
  </fieldset>
</center>
</form>
</body>

<? 
include("unconnect.inc"); 
?>

    