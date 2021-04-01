<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");
include("checklogin.php");

$choose = array();


array_push($choose,"ไข้");
array_push($choose,"ไอ");
array_push($choose,"เจ็บคอ");
array_push($choose,"มีเสมหะ");
array_push($choose,"มีน้ำมูก");
array_push($choose,"ปวดศีรษะ");
array_push($choose,"เวียนศีรษะ");
array_push($choose,"คลื่นไส้");
array_push($choose,"อาเจียน");
array_push($choose,"ใจสั่น");
array_push($choose,"อ่อนเพลีย");
array_push($choose,"เบื่ออาหาร");
array_push($choose,"หายใจเหนื่อยหอบ");
array_push($choose,"จุกแน่นท้อง");
array_push($choose,"เจ็บหน้าอก");
array_push($choose,"หน้ามืด ตาลาย");
array_push($choose,"ปวดท้อง");
array_push($choose,"อืดท้อง");
array_push($choose,"ถ่านอุจจาระเหลว");
array_push($choose,"ท้องผูก");
array_push($choose,"ปัสสาวะแสบขัด");
array_push($choose,"ปวดหลัง");
array_push($choose,"ปวดเอว");
array_push($choose,"ปวดแขน");
array_push($choose,"ปวดขา");
array_push($choose,"ปวดน่อง");
array_push($choose,"ปวดไหล่");
array_push($choose,"ปวดสะโพก");

sort($choose);

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
if(isset($_GET["action"]) && $_GET["action"] == "searchicd10"){
	
	$sql = "Select code, detail,diag_thai,diag_eng From icdthai where (code like '%".$_GET["search"]."%' OR detail LIKE '%".$_GET["search"]."%' OR diag_thai LIKE '%".$_GET["search"]."%' ) limit 50";
	$result = mysql_query($sql);

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
				<td width=\"10%\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"35%\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"20%\"><font style=\"color: #FFFFFF\"><strong>ชื่อย่อ</strong></font></td>
				<td width=\"30%\"><font style=\"color: #FFFFFF\"><strong>ชื่อเต็มไทย</strong></font></td>
				<td width=\"5%\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

		if(isset($_GET['num'])){
			$_GET["getto2"]="dt_diag_other".$_GET['num'];
			$_GET["getto"]="dt_icd10_other".$_GET['num'];
		}
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFAA00";
				else
					$bgcolor="#C5E8FC";
					
		if(isset($_GET['num'])){
			echo "<tr bgcolor=\"$bgcolor\" >
					<td>",$arr["code"],"</td>
					<td align=\"center\"><A HREF=\"javascript:void(0);\" class=\"rediagkey\" Onclick=\"testNotiRdu('".strtolower($arr["code"])."');document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('list').innerHTML ='';\">",$arr["detail"],"</A></td>
					<td>",$arr["diag_eng"],"</td>
					<td >",$arr["diag_thai"],"</td>
					<td></td>
				</tr>
			";
		}else{
			echo "<tr bgcolor=\"$bgcolor\" >
					<td>",$arr["code"],"</td>
					<td align=\"center\"><A HREF=\"javascript:void(0);\" class=\"rediagkey\" Onclick=\"testNotiRdu('".strtolower($arr["code"])."');document.getElementById('".$_GET["getto"]."').value = '",$arr["code"],"';document.getElementById('".$_GET["getto2"]."').value = '",jschars($arr["detail"]),"';document.getElementById('diag_thai').value = '",jschars($arr["diag_thai"]),"';document.getElementById('list').innerHTML ='';\">",$arr["detail"],"</A></td>
					<td>",$arr["diag_eng"],"</td>
					<td >",$arr["diag_thai"],"</td>
					<td></td>
				</tr>
			";
		}
		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
		?>
		<script>
		
		</script>
		<?php
	}
		exit();
}
//////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "searchthai"){
	
	$sql = "Select code, detail,diag_thai,diag_eng From icdthai where (diag_thai LIKE '%".$_GET["search1"]."%' or diag_eng LIKE '%".$_GET['search1']."%' limit 30) ";
	$result = mysql_query($sql);

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:600px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
		<TR>
			<TD>
		<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#330000\">
				<td width=\"10%\"><font style=\"color: #FFFFFF\"><strong>ICD10</strong></font></td>
				<td width=\"35%\"><font style=\"color: #FFFFFF\"><strong>Diag</strong></font></td>
				<td width=\"20%\"><font style=\"color: #FFFFFF\"><strong>ชื่อย่อ</strong></font></td>
				<td width=\"30%\"><font style=\"color: #FFFFFF\"><strong>ชื่อเต็มไทย</strong></font></td>
				<td width=\"5%\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list1').innerHTML ='';\">X</A></strong></font></td>
			</tr>";

	
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFAA00";
				else
					$bgcolor="#C5E8FC";
					
		
			echo "<tr bgcolor=\"$bgcolor\" >
					<td>",$arr["code"],"</td>
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('diag_thai').value = '",jschars($arr["diag_thai"]),"';document.getElementById('dt_diag').value = '",jschars($arr["detail"]),"';document.getElementById('dt_icd10').value = '",$arr["code"],"';document.getElementById('list1').innerHTML ='';\">",$arr["detail"],"</A></td>
					<td>",$arr["diag_eng"],"</td>
					<td >",$arr["diag_thai"],"</td>
					<td></td>
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
///////////////////////////////////////////


if(isset($_GET["action"]) && $_GET["action"] == "diag"){
	
	$sql = "Select distinct diag,icd10 from opday where doctor = '".$_SESSION["dt_doctor"]."'  and diag like '%".$_GET["search1"]."%' and icd10!='' limit 10 ";
	$result = mysql_query($sql);
	if(Mysql_num_rows($result) == 0){
		$sql = "Select distinct diag,icd10 from diag where diag like '%".$_GET["search1"]."%' and hn='".$_SESSION['hn_now']."' and status='Y' limit 10 ";
		$result = mysql_query($sql);
	}
	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:500px; height:200px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr  bgcolor=\"#333333\">
		<td align=\"center\" width=\"35%\" valign=\"top\"><font style=\"color: #FFFFFF;\"><strong>Diag</strong></font></td>
		<td width=\"20%\" valign=\"top\"><font style=\"color: #FFFFFF;\"><strong>ICD10</strong></font></td>
		<td width=\"5%\" valign=\"top\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list1').innerHTML='';\">
		<font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		if(isset($_GET['num'])){
			$_GET["getto"]="dt_diag_other".$_GET['num'];
			$_GET["getto2"]="dt_icd10_other".$_GET['num'];
		}
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",jschars($se["diag"]),"';document.getElementById('".$_GET["getto2"]."').value = '",$se["icd10"],"';document.getElementById('list1').innerHTML ='';\">&nbsp;",$se["diag"],"</A></td><td valign=\"top\">",$se["icd10"],"</td><td valign=\"top\">&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
///////////////////////////////////////////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "date_remed"){
	
?>
<FORM name="formrediag" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="45" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall(this.checked)"/></td>
            <td align="center" >DIAG</td>
			<td align="center" >ICD10</td>
            <td align="center" >ประเภท</td>
			<td align="center" >เลือก PRINCIPLE</td>
          </tr>

<?php
	
	$sql = "SELECT * from diag WHERE regisdate like '".$_GET["date_remed"]."%' and hn = '".$_SESSION["hn_now"]."' and status ='Y' ";

	$result = mysql_query($sql) or die(mysql_error());
	$i=0;
	$j=0;
	
	while($arr = mysql_fetch_assoc($result)){
		if($i%2==0)
			$bgcolor="#FFFF99";
		else
			$bgcolor="#FFFFFF";
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="45" align="center">
			  <?php  $i++; $j++;?><INPUT TYPE="checkbox" NAME="rediag<?php echo $i;?>" id="rediag<?php echo $i;?>" >
            </td>
            <td>&nbsp;
<A HREF="javascript:void(0);" class="rediagtest" onClick="testNotiRdu('<?=strtolower($arr["icd10"]);?>');document.getElementById('dt_diag').value='<?=jschars($arr["diag"])?>';document.getElementById('dt_icd10').value='<?=$arr["icd10"]?>';document.getElementById('head_remed').style.display='none';"><?php echo $arr["diag"];?></A></td>
			<td align="center">&nbsp;<?php echo $arr["icd10"];?>
            <input type="hidden" name="code<?=$i?>" id="code<?=$i?>" value="<?php echo $arr["icd10"];?>">
            <input type="hidden" name="detail<?=$i?>" id="detail<?=$i?>" value="<?php echo jschars($arr["diag"]);?>">
            <input type="hidden" name="detailthai<?=$i?>" id="detailthai<?=$i?>" value="<?php echo jschars($arr["diag_thai"]);?>"></td>
            <td align="center" ><?php echo $arr["type"];?></td>
			<td align="center" ><input type="radio" name="d_princ" value="<?=$i?>" id="d_princ<?=$i?>"></td>
          </tr>
<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_remed').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
		    <td colspan="3" align="center"><input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli();document.getElementById('head_remed').style.display='none';"/></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}

?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?></title>
<style type="text/css">

body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.font3 {
	font-size: 18px;
}

</style>

</head>
<body>

<!-- <a href='../nindex.htm'>&lt;&lt;ไปเมนู</a><BR>
<A HREF="dt_index.php">&lt;&lt; เลือกผู้ป่วยใหม่</A> -->

<?php include("dt_menu.php");?>
<?php include("dt_patient.php");?>


<SCRIPT LANGUAGE="JavaScript">

function checkForm(pt){
//R01 เงินสด"||pt=="R02 เบิกคลังจังหวัด"||pt=="R04 รัฐวิสาหกิจ"||pt=="R21 องค์กรปกครองส่วนท้องถิ่น"||pt=="R16 ศึกษาธิการ(ครูเอกชน)"

	if(document.form_diag.dt_diag.value == ""){

		alert("กรุณา DIAGNOSIS โรค ด้วยครับ \n * กรุณา DIAGNOSIS เป็นภาษาไทย เพื่อใช้ในการออกใบเสร็จ");
		return false;
	}
	/*else if(document.form_diag.diag_thai.value==''&&(pt.substring(0,3)=="R01"||pt.substring(0,3)=="R02"||pt.substring(0,3)=="R04"||pt.substring(0,3)=="R21"||pt.substring(0,3)=="R16")){
		alert("กรุณาระบุชื่อโรคเป็นภาษาไทยด้วยคะ");
		return false;
	}*/
	else if(pt.substring(0,3)=="R01"||pt.substring(0,3)=="R02"||pt.substring(0,3)=="R04"||pt.substring(0,3)=="R21"||pt.substring(0,3)=="R16"){
		if(document.form_diag.dt_diag.value!=''&&document.form_diag.dt_icd10.value==''){
			return true;
		}else if(document.form_diag.dt_icd10.value!=''&&document.form_diag.diag_thai.value==''){
			alert("กรุณาระบุชื่อโรคเป็นภาษาไทยด้วยคะ");
			return false;
		}
		
	}
	else{
		return true;
	}

}

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

function searchSuggest(str,len,getto,getto2) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dt_diag.php?action=searchicd10&search=' + str+'&getto=' + getto+'&getto2=' + getto2;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest1(str,len,getto,getto2) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_diag.php?action=diag&search1=' + str+'&getto=' + getto+'&getto2=' + getto2;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}
function searchSuggest2(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_diag.php?action=diag&search1=' + str+'&num=' + number;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest3(str,len,number) {

		str = str+String.fromCharCode(event.keyCode);
		if(str.length >= len){
			url = 'dt_diag.php?action=searchicd10&search=' + str+'&num=' + number;
			
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest4(str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_diag.php?action=searchthai&search1=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function addRow()
{ 
	var count_row=document.getElementById('rowcomo').rows.length ;
	if(count_row<16){
		var _table = document.getElementById('rowcomo').insertRow(count_row);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2); 
		var cell3 = _table.insertCell(3); 
		var cell4 = _table.insertCell(4);
		var getto = "dt_icd10_other"+count_row;
		var getto2 = "dt_diag_other"+count_row;
		
		cell0.align= "right";
		cell0.innerHTML = '<font class="font3">OTHER ค้นหา:</font>';
		cell1.innerHTML = '<input name="dt_icd10_other'+(count_row)+'" type="text" id="dt_icd10_other'+(count_row)+'" size="8" onKeyPress="searchSuggest3(this.value,3,'+(count_row)+')" >';
		cell2.align= "right";
		cell2.innerHTML = '<input name="dt_diag_other'+(count_row)+'" class="other_diag" type="text" id="dt_diag_other'+(count_row)+'" size="35" onKeyPress="searchSuggest2(this.value,2,'+(count_row)+')">';
		cell3.innerHTML=  '&nbsp;';
	}
}

function showremed(){
	
	if(document.getElementById("head_remed").style.display=="")
		document.getElementById("head_remed").style.display="none";
	else
		document.getElementById("head_remed").style.display="";

	
}

function select_dateremed(date_remed){

	xmlhttp = newXmlHttp();
	url = 'dt_diag.php?action=date_remed&date_remed=' + date_remed;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_remed").innerHTML = xmlhttp.responseText;
}

function checkall(xx){
	
	var max = document.formrediag.totalcheck.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("rediag"+i).checked = xx;
	}

}

function addtolist_muli(){
	var max = document.formrediag.totalcheck.value;
	var count_row=document.getElementById('rowcomo').rows.length ;
	k=count_row-1;
	if(eval(max) > 0){

		var test_from_list = false;
		var testAcute = false;

		for(i=1;i<=max;i++){
			if(document.getElementById("rediag"+i).checked == true){
				if(document.getElementById("d_princ"+i).checked== true){
					document.getElementById('dt_icd10').value =document.getElementById("code"+i).value;
					document.getElementById('dt_diag').value = document.getElementById("detail"+i).value;
					document.getElementById('diag_thai').value = document.getElementById("detailthai"+i).value;
				}else{		
					document.getElementById('dt_icd10_other'+k).value =document.getElementById("code"+i).value;
					document.getElementById('dt_diag_other'+k).value = document.getElementById("detail"+i).value;
					addRow();
					k++;
				}

				// เทสดูว่ามีตัวไหนในรายการติดรึป่าว
				var icd = document.getElementById("code"+i).value.toLocaleLowerCase();
				if( testRdu6(icd) === true ){
					test_from_list = true;
				}

				if( rduIn7(icd) === true ){
					testAcute = true;
				}
			}

		} // end for

		// ถ้ามีตัวใดตัวหนึ่งติดก็ให้แจ้งเตือน
		if( test_from_list === true ){
			notiPharyngitis();
		}

		if( testAcute === true ){
			notifyAcuteDiarrhea();
		}

	}


}


</SCRIPT>



<FORM name="form_diag" METHOD=POST ACTION="dt_diag_add.php" Onsubmit="return checkForm('<?=$_SESSION['ptright_now']?>');">
<TABLE border="0">
<TR valign="top">
  <TD width="250" height="69" rowspan="7" align="right">ความเห็นแพทย์
  </TD>
  <TD ><textarea id="dt_diag_detail" name="dt_diag_detail" rows="3" cols="100" ><?php echo $_SESSION["dt_diag_detail"]?></textarea></TD>
 </TR>
<TR  colspan="5" valign="top">
<TD ><A HREF="javascript:showremed();">Re-Diag</A><font   color="#FF0033" size="3"> *** การ DIAG สามารถค้นหาชื่อโรคทั้งภาษาไทยและภาษาอังกฤษได้ที่ช่องค้นหา *** <br><strong>*** ห้ามใส่สัญลักษณ์พิเศษ เช่น เครื่องหมาย ' ในการ Diag โรค จะทำให้สั่งยาไม่ได้***</strong></font></TD>
<TD ></TD>
 </tr>
<TR   colspan="5" valign="top">
<table id="rowcomo" width="100%">
	<TD width="150" align="right"  class="font3">PRINCIPLE ค้นหา:</TD>
	<TD width="48" ><Div id="list1" style="left:70PX;top:170PX;position:absolute;"></Div>
	  <input name="dt_icd10" type="text" id="dt_icd10" onKeyPress="searchSuggest(this.value,3,'dt_icd10','dt_diag')" value="<?php echo $_SESSION["dt_icd10"]?>" size="8"></TD>
	<TD width="210" >
	<? if($_SESSION["dt_doctor"]=="ธนบดินทร์ ผลศรีนาค (ว.19921)" || $_SESSION["dt_doctor"]=="มนต์ชัย พรพัฒนะเจริญชัย (ว.25958)"){  //ได้รับคำสั่งจากหมอธนบดินทร์ เมื่อ 13/07/59 และหมอมนต์ชัย เมื่อ 21/07/59 ?>        
    <input name="dt_diag" type="text" id="dt_diag"  value="<?php echo $_SESSION["dt_diag"]?>" size="40">
    <? }else{ ?>
    <input name="dt_diag" type="text" id="dt_diag" onKeyPress="searchSuggest1(this.value,2,'dt_diag','dt_icd10')" value="<?php echo $_SESSION["dt_diag"]?>" size="40">
    <? } ?>
</TD>
	<TD   class="font3">Thai :<input name="diag_thai" type="text" id="diag_thai" size="30" onKeyPress="searchSuggest4(this.value,2)" value="<?php echo $_SESSION["diag_thai"]?>" ></TD>
         </tr></table></td>
</TR>
<TR>
<td colspan="5">
	<table id="rowcomo" width="100%">
    <tr>
	<TD width="144" align="right" valign="middle" class="font3">OTHER :ค้นหา </TD>
	<TD width="53" valign="middle"><Div id="list" style="left:200PX;top:170PX;position:absolute;"></Div>
	  <input name="dt_icd10_other0" type="text" id="dt_icd10_other0" onKeyPress="searchSuggest3(this.value,3,'0');" value="<?php echo $_SESSION["dt_icd10_other"]?>" size="8"></TD>
		<TD width="373" valign="middle">
	<? if($_SESSION["dt_doctor"]=="ธนบดินทร์ ผลศรีนาค (ว.19921)" || $_SESSION["dt_doctor"]=="มนต์ชัย พรพัฒนะเจริญชัย (ว.25958)"){  //ได้รับคำสั่งจากหมอธนบดินทร์ เมื่อ 13/07/59 และหมอมนต์ชัย เมื่อ 21/07/59 ?>        
        <input name="dt_diag_other0" type="text" class="other_diag" id="dt_diag_other0" value="<?php echo $_SESSION["dt_diag_other"]?>" size="35">
        <? }else{ ?>
        <input name="dt_diag_other0" type="text" class="other_diag" id="dt_diag_other0" onKeyPress="searchSuggest2(this.value,2,'0');" value="<?php echo $_SESSION["dt_diag_other"]?>" size="35">
        <? } ?>
        </TD>
	<TD width="75" valign="bottom">&nbsp;</TD>      
</TR>

<TR>
	<TD></TD>
	<TD id="dt_diag_value"></TD>
    <TD width="41" align="right" valign="middle" id="dt_diag_value"></TD>
    <TD valign="middle" id="dt_diag_value"></TD>
</TR>
<TR>
<TD colspan="2" align="center"><input type="button" name="input" value="เพิ่มรายการ OTHER" onClick="addRow();" style="position: absolute;"></TD>

	<TD colspan="2" align="center"><br>	  <INPUT TYPE="submit" value="        บันทึก         " name="save" onKeyDown=" if(event.keyCode == 38){document.form_diag.dt_icd10.focus();}"></TD>
</TR>
</TABLE>
</FORM>

<div id="notify_rdu6" style="position: absolute; left:25%; top:15%; border: 4px solid red; display: none;">
	<div id="closeNotifyIdu6" style="background-color: red; font: #000000; text-align: center; font-weight: bold; cursor: pointer;">[ปิด]</div>
	<div style="background-color: #ffffff; color: #000000; text-align: center;">
		<div>แจ้งเตือน การใช้ยาอย่างสมเหตุผล</div>
		<img src="images/noti_centorCriteria.jpg" alt="Centor Criteria">
	</div>
</div>

<div id="notify_rdu7" style="position: absolute; left:25%; top:15%; border: 4px solid #ffc107; display: none;">
	<div id="closeNotifyIdu7" style="background-color: #ffc107; font: #000000; text-align: center; font-weight: bold; cursor: pointer;">[ปิด]</div>
	<div style="background-color: #ffffff; color: #000000; text-align: center;">
		<div>แจ้งเตือน การใช้ยาอย่างสมเหตุผล</div>
		<div>กรณีที่ควรให้ยาปฏิชีวนะ : ท้องร่วงชนิด Invasive (แบคทีเรียลุกล้ำเข้าไปในผนังลำไส้) มีไข้ > 38 ํC<br><b><u>และ</u></b>อุจจาระมีเลือดปนเห็นได้ด้วยตาเปล่า หรือตรวจพบ RBC(เม็ดเลือดแดง) และ WBC(เม็ดเลือดขาว) ในอุจจาระ</div>
	</div>
</div>

<!-- Layer Remed ยา -->
<div id="head_remed" style='left:300PX;top:60PX;width:100PX;height:30PX;position:absolute; display:none;'>
<TABLE align="center" border="1" bordercolor="#3300FF" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#3300FF" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>วันที่มาตรวจ : </strong>
		  <select name="date_diag" onChange="select_dateremed(this.value);">
		 <?php
			$date_remed ="";
			$sql = "SELECT distinct(substr(regisdate,1,10)) as regisdate from diag WHERE hn = '".$_SESSION["hn_now"]."' order by row_id desc";
			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				$date1= substr($arr["regisdate"],8,2)."/".substr($arr["regisdate"],5,2)."/".substr($arr["regisdate"],0,4);
				$date2= substr($arr["regisdate"],0,10);
				echo "<option value=\"",$date2,"\">",$date1,"</option>";
				if($date_remed == "") $date_remed = $date2;
			}
			$list_onload .= "select_dateremed('".$date_remed."'); \n";
		 ?>
		    
		    </select>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_remed">
    </DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){

	document.getElementById("dt_diag_detail").focus();
	<?php echo $list_onload;?>
}

</SCRIPT>


<script>

	if(typeof String.prototype.trim !== 'function'){
		String.prototype.trim = function(){
			return this.replace(/^\s+|\s+$/g, '');
		}
	}

	if(!Array.prototype.indexOf){
		Array.prototype.indexOf = function(obj, start){
			for(var i = (start || 0), j=this.length; i<j; i++){
				if(this[i] === obj){
					return i;
				}
			}
			return -1;
		}
	}

	/**
	 * @readme default เป็น false แต่ถ้าเจอ icd10 ตามรายการจะ return เป็น true
	 * @todo icd10 เป็นแบบ lowercase
	 */
	function testRdu6(icd){
		// var icdRdu6 = Array('j020','j039','j040','j20','j02','j03');
		var icdRdu6 = Array('j00','j068','j069','j111','j209','j04','j05','j06','j07','j011');
		var in6test = false;
		if( icdRdu6.indexOf(icd) > -1 ){
			in6test = true;
		}
		return in6test;
	}

	function notiPharyngitis(){
		document.getElementById('notify_rdu6').style.display = 'block';
	}

	function testRdu6KeyStroke(testText){
		var res = testText.match(/URI/g);
		if( res !== null ){
			notiPharyngitis();
		}
	}

	function notifyAcuteDiarrhea(){
		document.getElementById('notify_rdu7').style.display = 'block';
	}

	function rduIn7(testText){
		var testCase = Array('a000','a001','a009','a020','a030', 'a031', 'a032', 'a033', 'a038', 'a039','a040','a041','a042','a043','a044','a045','a046','a047','a048','a049','a050', 'a053', 'a054', 'a059','a080', 'a081', 'a082', 'a083', 'a084', 'a085','a09', 'a090', 'a099','k521', 'k528', 'k529');
		var in7test = false;
		if( testCase.indexOf(testText) > -1 ){
			in7test = true;
		}
		return in7test;
	}

	function testNotiRdu(icd10){
		if( testRdu6(icd10) === true ){
			notiPharyngitis();
		}

		if( rduIn7(icd10) === true ){
			notifyAcuteDiarrhea();
		}
	}

</script>
<script src="js/jquery-1.8.0.min.js"></script>
<script>

jQuery.noConflict();
(function( $ ) {
  $(function() {
 
		// คลิกจาก rediag
		// $(document).on('click', '.rediagtest', function(){
			
		// 	var get_data_id = $(this).attr('data-item-id');
		// 	var icd = $('#code'+get_data_id).val().toLocaleLowerCase();
			
		// 	if( testRdu6(icd) === true ){
		// 		notiPharyngitis();
		// 	}

		// 	if( rduIn7(icd) === true ){
		// 		notifyAcuteDiarrhea();
		// 	}

		// });

		// คีย์มือแล้วเลือกจากpopup
		// $(document).on('click', '.rediagkey', function(){
		// 	// console.log(this);
		// 	var icd = $(this).attr('data-code').toLocaleLowerCase();
		// 	// console.log(icd);
		// 	if( testRdu6(icd) === true ){
		// 		notiPharyngitis();
		// 	}

		// 	if( rduIn7(icd) === true ){
		// 		notifyAcuteDiarrhea();
		// 	}

		// });

		// ปิด popup ตัวชี้วัดที่6
		$(document).on('click', '#closeNotifyIdu6', function(){
			$('#notify_rdu6').hide();
		});

		$(document).on('click', '#closeNotifyIdu7', function(){
			$('#notify_rdu7').hide();
		});


		$(document).on('focusout', '#dt_diag', function(){ 
			var testText = $(this).val().toLocaleLowerCase();
			testRdu6KeyStroke(testText);
		});

		$(document).on('focusout', '.other_diag', function(){ 
			var testText = $(this).val().toLocaleLowerCase();
			testRdu6KeyStroke(testText);
		});

		
		
	});
})(jQuery);

</script>

</body>
<?php include("unconnect.inc");?>
</html>