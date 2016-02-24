<style type="text/css">
<!--
.forntsarabun {
font-family: "TH SarabunPSK";
font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>

<?php

include("connect.inc");


$query = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";

$result = mysql_query($query) or die("Query pocompany fail");



for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {

if (!mysql_data_seek($result, $i)) {

echo "Cannot seek to row $i\n";

	continue;

}



if(!($row = mysql_fetch_object($result)))

	continue;

}

//31

$chn=$row->hn;

$can=$row->an;

$cptname=$row->ptname;

$cage=$row->age;

$cptright=$row->ptright;

$cbedcode=$row->bedcode;

$cdoctor=$row->doctor;
$cdiagnos=$row->diagnos;
$cBed1=$row->bed;










////

///po97 ใบที่ 1


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

print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:'TH SarabunPSK';FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:'TH SarabunPSK';FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:'TH SarabunPSK';FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:0PX;top:0PX;width:306PX;height:30PX;'><span class='fc1-0'>$cbedname&nbsp;&nbsp;$cBed1</span></DIV>";

print "<DIV style='left:0PX;top:20PX;width:306PX;height:30PX;'><span class='fc1-0'>AN:$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;</span></DIV>";
print "<DIV style='left:0PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-2'>$cptname&nbsp;&nbsp;อายุ&nbsp;$cage</span></DIV>";
print "<DIV style='left:0PX;top:60PX;width:500PX;height:30PX;'><span class='fc1-1'>โรค&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp; </span></DIV>";
print "<DIV style='left:0PX;top:80PX;width:306PX;height:30PX;'><span class='fc1-1'>แพทย์&nbsp;$cdoctor</span></DIV>";


print "</BODY></HTML>";


?>
<div style="left: 0; top: 100px;" id="no_print">
	<button onclick="printOut()" >พิมพ์ใบ</button>
</div>

<script type="text/javascript">
	function printOut(){
		window.print();
	}
</script>