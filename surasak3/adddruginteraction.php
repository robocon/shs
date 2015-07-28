<?php
session_start();
include("connect.inc");
if($_POST["act"]=="add"){
   $sql="select * from drug_interaction where first_drugcode='$_POST[drugcode1]' and between_drugcode='$_POST[drugcode2]'";
   $query=mysql_query($sql) or die ("Query Error");
   if(mysql_num_rows($query) >= 1){
   echo "<script>alert('มีข้อมูลยา $_POST[drugcode1] และ $_POST[drugcode2] ในระบบแล้ว');window.location='adddruginteraction.php';</script>";
   }else{
   $add="insert into drug_interaction set first_drugcode='$_POST[drugcode1]',
															between_drugcode='$_POST[drugcode2]',
															first_tradname='$_POST[tradname1]',
															between_tradname='$_POST[tradname2]',
															first_genname='$_POST[genname1]',
															between_genname='$_POST[genname2]',															
															effect='$_POST[effect]',
															action='$_POST[action]',
															follow='$_POST[follow]',
															onset='$_POST[onset]',
															violence='$_POST[violence]',
															referable='$_POST[referable]',
															status='$_POST[status]'";
   if(mysql_query($add)){
   $add1="insert into drug_interaction set first_drugcode='$_POST[drugcode2]',
															between_drugcode='$_POST[drugcode1]',
															first_tradname='$_POST[tradname2]',
															between_tradname='$_POST[tradname1]',
															first_genname='$_POST[genname2]',
															between_genname='$_POST[genname1]',																
															effect='$_POST[effect]',
															action='$_POST[action]',
															follow='$_POST[follow]',
															onset='$_POST[onset]',
															violence='$_POST[violence]',
															referable='$_POST[referable]',
															status='$_POST[status]'";
  mysql_query($add1);		
  //echo $add."<br>";
  //echo $add1;
  echo "<script>alert('บันทึกข้อมูลเสร็จแล้ว');window.location='showdruginteraction.php';</script>";									
  }else{
  echo "<script>alert('ผิดพลาด ไม่สามารถบันทึกข้อมูลได้');window.location='adddruginteraction.php';</script>";	
  }
  } //close if num
}  //close if act

///////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "drugreact"){
	
	$sql = "Select drugcode,tradname,genname from druglst where tradname like '%".$_GET["search"]."%' or drugcode like '%".$_GET["search"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td width=\"25\"><strong>&nbsp;</strong></td>
		<td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>Drugcode</strong></font></td>
		<td width=\"30\"><font style=\"color: #FFFFFF;\"><strong>Tradname</strong></font></td>
		<td width=\"30\"><font style=\"color: #FFFFFF;\"><strong>genname</strong></font></td>
		<td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" 
		Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".$se["drugcode"]."';
		document.getElementById('".$_GET["getto2"]."').value = '".$se["tradname"]."';
		document.getElementById('".$_GET["getto3"]."').value = '".$se["genname"]."';
		document.getElementById('list').innerHTML ='';\">".$se["drugcode"]."</A></td>
		<td>".$se['tradname']."</td>
		<td>&nbsp;</td>
		</tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
///////////////////////////////
?>
<script>
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
function searchSuggest(str,len,getto,getto2,getto3) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'adddruginteraction.php?action=drugreact&search='+ str+'&getto='+ getto+'&getto2='+ getto2+'&getto3='+ getto3;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<div align="center">
  <form name="form1" method="post" action="adddruginteraction.php">
  <Div id="list" style="left:400PX;top:80PX;position:absolute;"></Div>
  <input name="act" type="hidden" value="add">
    <p align="center"><strong>เพิ่มข้อมูล Drug Interaction</strong></p>
	<div align="center"><a href="../nindex.htm">ไปหน้าแรก</a> || <a href="showdruginteraction.php">ข้อมูล drug interaction</a></div>
    <hr>    
    <table width="80%" height="302" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td width="35%" align="right"><strong>first_drugcode</strong></td>
        <td width="3%" align="center"><strong>:</strong></td>
        <td width="62%"><input type='text' name='drugcode1' size='10' id="drugcode1" onKeyPress="searchSuggest(this.value,2,'drugcode1','tradname1','genname1');">
        &nbsp;&nbsp;&nbsp;
        <input type='text' name='tradname1' size='20' id="tradname1" onKeyPress="searchSuggest(this.value,2,'drugcode1','tradname1','genname1');">
        &nbsp;&nbsp;&nbsp;
        <input type='text' name='genname1' size='20' id="genname1" onKeyPress="searchSuggest(this.value,2,'drugcode1','tradname1','genname1');"></td>
      </tr>
      <tr>
        <td align="right"><strong>between_drugcode</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input type='text' name='drugcode2' size='10' id="drugcode2" onKeyPress="searchSuggest(this.value,2,'drugcode2','tradname2','genname2');">
        &nbsp;&nbsp;&nbsp;
        <input type='text' name='tradname2' size='20' id="tradname2" onKeyPress="searchSuggest(this.value,2,'drugcode2','tradname2','genname2');">
        &nbsp;&nbsp;&nbsp;
        <input type='text' name='genname2' size='20' id="genname2" onKeyPress="searchSuggest(this.value,2,'drugcode2','tradname2','genname2');"></td>
      </tr>
      <tr>
        <td align="right"><strong>effect</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input type="text" name="effect" id="effect"></td>
      </tr>
      <tr>
        <td align="right"><strong>action</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input type="text" name="action" id="action"></td>
      </tr>
      <tr>
        <td align="right"><strong>follow</strong></td>
        <td width="3%" align="center"><strong>:</strong></td>
        <td><input type="text" name="follow" id="follow"></td>
      </tr>
      <tr>
        <td align="right"><strong>onset</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input type="text" name="onset" id="onset"></td>
      </tr>
      <tr>
        <td align="right"><strong>violence</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input type="text" name="violence" id="violence"></td>
      </tr>
      <tr>
        <td align="right"><strong>referable</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input type="text" name="referable" id="referable"></td>
      </tr>
      <tr>
        <td align="right"><strong>ลักษณะการ Lock</strong></td>
        <td align="center"><strong>:</strong></td>
        <td>
          <input name="status" type="radio" id="radio" value="lock" checked>
          Lock
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="status" id="radio2" value="popup">
        Popup
        </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>
          <input type="submit" name="Submit" id="button" value="Save">
          &nbsp;&nbsp;&nbsp;
          <input type="reset" name="button2" id="button2" value="Reset">        </td>
      </tr>
    </table>
  </form>
</div>
