<body Onload="window.print();">
<?php
     session_start();

     $Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");
/*
print "VN: $nVn<br>";
print "HN: $cHn<br>";
print "ชื่อ: $cPtname<br>";
print "สิทธิ: $cPtright<br>";
*/

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

print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:40PX;top:10PX;width:100PX;height:30PX;'><span class='fc1-2'>VN: $nVn</span></DIV>";
print "<DIV style='left:150PX;top:10PX;width:300PX;height:30PX;'><span class='fc1-2'>HN: $cHn</span></DIV>";
print "<DIV style='left:300PX;top:10PX;width:200PX;height:30PX;'><span class='fc1-0'>$Thaidate</span></DIV>";
print "<DIV style='left:400PX;top:40PX;width:500PX;height:30PX;'><span class='fc1-1'>สิทธิ : $cPtright</span></DIV>";
print "<DIV style='left:60PX;top:40PX;width:500PX;height:30PX;'><span class='fc1-1 '>$cPtname</span></DIV>";
print "<DIV style='left:280PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>อายุ $cAge</span></DIV>";
print "<DIV style='left:50PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตร ปชช:  $cIdcard</span></DIV>";
print "<DIV style='left:270PX;top:70PX;width:300PX;height:30PX;'><span class='fc1-0'>#.$cIdguard</span></DIV>";
print "<DIV style='left:380PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-0'>$cNote:</span></DIV>";
//print "<DIV style='left:520PX;top:10PX;width:306PX;height:30PX;'><span class='fc1-0'>$sOfficer..ตรวจสอบสิทธิ</span></DIV>";




print "</BODY></HTML>";



 include("connect.inc");  
    $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$cHn' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");

   if(mysql_num_rows($result)){
print "<div align='right'>";
print"<table border='0' width='80%'>";
	print"<tr>

		<td width='70%'><br></td>
		<td width='80%'><br><br><br><br><br><br>ประวัติการแพ้ยา";
  while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3></td>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3>$tradname...$advreact($asses)</td>\n".
                " </tr>\n");
  						    }
	print"	</td>";
	print"</tr>";
print"</table>";
print "</div>";


			}

   $query = "SELECT kew,toborow FROM opday WHERE  thdatehn = '$thdatehn' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");

   if(mysql_num_rows($result)){
print "<div align='right'>";
print"<table border='0' width='80%'>";
	print"<tr>

		<td width='70%'><br></td>
		<td width='80%'><br><br><br><br><br><br>";
  while (list ($kew,$toborow) = mysql_fetch_row ($result)) {

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

print ".fc1-2 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-7 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";


print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:500PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'>ลำดับที่:</span></DIV>";
print "<DIV style='left:580PX;top:10PX;width:900PX;height:70PX;'><span class='fc1-7'>$kew</span></DIV>";

print "<DIV style='left:510PX;top:0PX;width:500PX;height:30PX;'><span class='fc1-0'>ตรวจ..$toborow</span></DIV>";




print "</BODY></HTML>";
 print (" <tr>\n".
                "  <td ><font face='cordia New' size=3></td>\n".
                "  <td ><font face='cordia New' size=3></td>\n".
                " </tr>\n");
  						    }
	print"	</td>";
	print"</tr>";
            
print"</table>";
print "</div>";





			}

 include("unconnect.inc"); 
//add

?>
