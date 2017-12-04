<?php
session_start();
include("connect.inc");
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	$sql = "Select drugcode,tradname from druglst  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td width=\"10\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list1').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$se["drugcode"],"';document.getElementById('list1').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
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
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'prepack_stk.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}
</script>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<?
if(isset($_POST['okbtn'])){
	$Thaidate=(date("Y")+543).date("-m-d H:i:s");

	$query2 = "SELECT  drugcode,tradname,unit  FROM druglst WHERE drugcode ='".$_POST['dgcode']."' ";
	$result2 = mysql_query($query2);
	list($drugcode,$tradname,$unit) = mysql_fetch_array($result2);
	
	$query3 = "SELECT  mfdate ,expdate  FROM combill WHERE drugcode ='".$_POST['dgcode']."' and lotno = '".$_POST['lotno']."' ";
	$result3 = mysql_query($query3);
	list($mfdate,$expdate) = mysql_fetch_array($result3);
	$dt = explode("/",$_POST['dtime']);//01-10-2012
	
	///***6month***///
	$tomorrow = mktime(date("H"),date("i"),date("s"),$dt[1]+6,$dt[0],($dt[2]-543)); 
	$date3month = date("Y-m-d",$tomorrow);
	$expcut = substr($date3month,8,2)."/".substr($date3month,5,2)."/".(substr($date3month,0,4)+543);//วันหมดอายุที่แบ่งบรรจุ

	$print = $_POST['amount']/$_POST['amount2'];
	
	$sql7 = "insert into `stkprepack` ( `date` , `drugcode` , `tradname` , `mftdate` , `expdate` , `amount` , `pack` , `datecut` , `expcut` , `lotno` , `officer` ) VALUES ('".$Thaidate."','".$drugcode."','".$tradname."','".$mfdate."','".$expdate."','".$_POST['amount']."','".$print."','".$_POST['dtime']."','".$expcut."','".$_POST['lotno']."','".$sOfficer."' )";																																																																											
	mysql_query($sql7);																																				   
print "<HTML>";

print "<script>";

 print "ie4up=nav4up=false;";

 print "var agt = navigator.userAgent.toLowerCase();";

 print "var major = parseInt(navigator.appVersion);";

 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";

   print "ie4up = true;";

 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";

   print "nav4up = true;";

print "</script>";



print "<head>";

print "<STYLE>";

 print "A {text-decoration:none}";

 print "A IMG {border-style:none; border-width:0;}";

 print "DIV {position:absolute; z-index:25;}";

print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;}";
print ".fc1-6 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-7 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='left:32PX;top:0PX;width:500PX;height:30PX;'><span class='fc1-3'><b>&nbsp;$tradname </span><span class='fc1-6'>($drugcode) </b></span></DIV>";

print "<DIV style='left:32PX;top:20PX;width:500PX;height:30PX;'><span class='fc1-6'>&nbsp;LotNo. ".$_POST['lotno']."&nbsp;&nbsp;จำนวน ".$_POST['amount2']." $unit</span></DIV>";

//print "<DIV style='left:32PX;top:40PX;width:500PX;height:30PX;'><span class='fc1-6'>&nbsp;ผลิต:$mftdate&nbsp;&nbsp;หมดอายุ:$expdate</span></DIV>";

print "<DIV style='left:32PX;top:40PX;width:500PX;height:30PX;'><span class='fc1-6'>&nbsp;วันแบ่งบรรจุ:".$_POST['dtime']."</span></DIV>";

print "<DIV style='left:32PX;top:60PX;width:200PX;height:30PX;'><center><span class='fc1-4'>&nbsp;***วันหมดอายุ:".$expcut."***</span></center></DIV>";

?>
<div id="no_print" > 
<?
print "<DIV style='left:25PX;top:120PX;width:200PX;height:30PX;'><center><span class='fc1-4'>&nbsp;จำนวนที่พิมพ์ $print ใบ</span></center></DIV>";
?>
</div>
<?
print "</BODY></HTML>";


?>

<script>
window.print();
</script>
<?

}else{
	
?>
<style type="text/css">
<!--
.font11 {
	font-family: AngsanaUPC;
	font-size: 18px;
}
-->
</style>

<a target=_top  href="../nindex.htm"><< ไปเมนู</a>

<form name="form1" action="<?=$_SERVER['PHP_SELF']?>" method="post" target="_blank">
<strong class="font11"><br>พิมพ์ Stricker Prepack </strong>
<table width="51%">
<tr><td class="font11">รหัสยา 
<Div id="list1" style="left:190PX;top:70PX;position:absolute;"></Div>
<input type="text" name="dgcode"  id='dgcode'  onkeypress=" searchSuggest(this.value,3,'dgcode')"><br>
จำนวนทั้งหมด 
<input type="text" name="amount">
<br />
จำนวนต่อแพ็ค
<input type="text" name="amount2" />
<br>
LotNo. 
<input type="text" name="lotno"><br>
วันแบ่งบรรจุ
<input type="text" name="dtime" />
(ex.15/07/2556)<br>
<input type="submit" value="    ตกลง    " name="okbtn">
</td>
</tr>
</table>
</form>
<?
}
?>


