

<body Onload="window.print();">

<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
//CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$Thaidate1=substr(date("Y"),2,2).date("md");

   include("connect.inc");
$query = "SELECT * FROM runno WHERE title = 'lab'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}


$hn=$_GET['hn'];
$ptname=$_GET['ptname'];

//echo $_GET['pro'];
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
print ".fc1-4 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;}";
print ".fc1-6 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-7 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";
print "<DIV style='z-index:0'> &nbsp; </div>";


if($_GET['pro']=='BS'){

print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$hn&nbsp;<b></b>&nbsp;$Thaidate</span></DIV>";

print "<DIV style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'>$ptname</span></DIV>";

$labno=$_GET['labno']."02";

print "<DIV style='left:65PX;top:55PX;width:200PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";	

}else{ // ถ้าเป็น P1 , P2 

print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$hn&nbsp;<b></b>&nbsp;$Thaidate</span></DIV>";

print "<DIV style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'>$ptname</span></DIV>";

$labno=$_GET['labno']."01";

print "<DIV style='left:65PX;top:55PX;width:200PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";	
	
//print "<div style='page-break-after:always'></div>"; // แบ่งหน้า

print "<DIV style='left:0PX;top:120PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$hn&nbsp;<b></b>&nbsp;$Thaidate</span></DIV>";

print "<DIV style='left:0PX;top:135PX;width:500PX;height:30PX;'><span class='fc1-0'>$ptname</span></DIV>";

$labno=$_GET['labno']."02";

print "<DIV style='left:65PX;top:175PX;width:200PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";
}



print "</BODY></HTML>";



?>


