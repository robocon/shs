<body Onload="window.print();">
 <a target=_self  href="../nindex.htm"><<ไปเมนู</a>
<?php
    session_start();
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

print ".fc1-0 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:640PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-0'>1</span></DIV>";
print "<DIV style='left:150PX;top:50PX;width:200PX;height:30PX;'><span class='fc1-0'><A HREF=\"opedit.php?cHn=$vHN\" target=\"_blank\">$vHN</A></span></DIV>";
print "<DIV style='left:350PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$ptname</span></DIV>";
print "<DIV style='left:600PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$cAge</span></DIV>";
print "<DIV style='left:150PX;top:80PX;width:700PX;height:30PX;'><span class='fc1-1'>ว/ด/ป เกิด&nbsp;$birthdate&nbsp;&nbsp;ID:$idcard&nbsp;&nbsp;$ptright</span></DIV>";
print "</BODY></HTML>";

?>




