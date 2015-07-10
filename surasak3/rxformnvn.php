<?php
     session_start();

     $Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
/*
print "VN: $nVn<br>";
print "HN: $cHn<br>";
print "ชื่อ: $cPtname<br>";
print "สิทธิ: $cPtright<br>";
*/

$id1=substr($cIdcard,0,1);
$id2=substr($cIdcard,1,4);
$id3=substr($cIdcard,5,5);
$id4=substr($cIdcard,10,2);
$id5=substr($cIdcard,12,1);
//$cIdcard1=$id1  $id2 $id3  $id4  $id5;
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

print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:80PX;top:40PX;width:150PX;height:30PX;'><span class='fc1-2'>VN: ...........</span></DIV>";
print "<DIV style='left:180PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>HN: $cHn</span></DIV>";
print "<DIV style='left:280PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>$Thaidate</span></DIV>";
print "<DIV style='left:460PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-1'>สิทธิ : $cPtright</span></DIV>";
print "<DIV style='left:80PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-3 '>$cPtname</span></DIV>";
print "<DIV style='left:300PX;top:70PX;width:200PX;height:30PX;'><span class='fc1-0'>อายุ $cAge</span></DIV>";
print "<DIV style='left:410PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตร ปชช:  $cIdcard1</span></DIV>";
print "<DIV style='left:570PX;top:70PX;width:300PX;height:30PX;'><span class='fc1-0'>#.$cIdguard</span></DIV>";
print "<DIV style='left:400PX;top:120PX;width:306PX;height:30PX;'><span class='fc1-0'>$cNote:</span></DIV>";


print "<DIV style='left:400PX;top:150PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"opdprintbc.php?cHn=$idcard\"></span></DIV>";
print "<DIV style='left:400PX;top:220PX;width:500PX;height:50PX;'><span class='fc1-99'><img src = \"opdprintrxbc.php?cHn=$idcard\"></span></DIV>";



?>
