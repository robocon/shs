<body Onload="window.print();">
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(1/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>
<?php
     session_start();

     $Thaidate=date("d-m-").(date("Y")+543)." ����  ".date("H:i:s");
  $Thaidate1=date("dm").(date("Y"));
/*
print "VN: $nVn<br>";
print "HN: $cHn<br>";
print "����: $cPtname<br>";
print "�Է��: $cPtright<br>";
*/

print "<HTML>";print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:21PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:60PX;top:10PX;width:100PX;height:30PX;'><span class='fc1-2'>VN: $nVn</span></DIV>";
print "<DIV style='left:150PX;top:10PX;width:300PX;height:30PX;'><span class='fc1-2'>HN: $cHn</span></DIV>";
print "<DIV style='left:300PX;top:10PX;width:200PX;height:30PX;'><span class='fc1-0'>$Thaidate</span></DIV>";
print "<DIV style='left:410PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-1'>�Է�� : $cPtright</span></DIV>";
print "<DIV style='left:60PX;top:40PX;width:500PX;height:30PX;'><span class='fc1-1 '>$cPtname</span></DIV>";
print "<DIV style='left:300PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>���� $cAge</span></DIV>";

$cIdcard1=substr($cIdcard,0,1);
$cIdcard2=substr($cIdcard,1,4);
$cIdcard3=substr($cIdcard,5,5);
$cIdcard4=substr($cIdcard,10,2);
$cIdcard5=substr($cIdcard,12,1);
$cIdcard9=$cIdcard1."-".$cIdcard2."-".$cIdcard3."-".$cIdcard4."-".$cIdcard5;

print "<DIV style='left:50PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-0'>�ѵ� ���:  $cIdcard9</span></DIV>";
print "<DIV style='left:240PX;top:70PX;width:300PX;height:30PX;'><span class='fc1-0'>#.$cIdguard</span></DIV>";
print "<DIV style='left:20PX;top:100PX;width:500PX;height:30PX;'><span class='fc1-0'>$cNote:</span></DIV>";
//print "<DIV style='left:410PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-4'>�Ţ�����Ӥѭ:$Thaidate1$nVn</span></DIV>";
//print "<DIV style='left:520PX;top:10PX;width:306PX;height:30PX;'><span class='fc1-0'>$sOfficer..��Ǩ�ͺ�Է��</span></DIV>";
print "<DIV style='left:50PX;top:130PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"printbcpha.php?cHn=$idcard\"></span></DIV>";
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
		<td width='80%'><br><br><br><br><br><br><br>";
  while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3></td>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3></td>\n".
                " </tr>\n");
  						    }
	print"	</td>";
	print"</tr>";
print"</table>";
print "</div>";


			}

$sql = "SELECT inrxform FROM opcard WHERE  hn = '".$cHn."' limit 1";
$result = Mysql_Query($sql);
list($note) = Mysql_fetch_row($result);

if($note != ""){
	if($note == "�����¡��������§��ͧ���Ѻ��éմ�Ѥ�չ��ͧ�ѹ�ä����Ѵ�˭�(���)")
		$note .= "<BR>Influza Vaccine 0.5 ml. IM";
	print "<DIV style='left:340PX;top:130PX;width:500PX;height:30PX'><span class='fc1-0'>".$note."</span></DIV>";
}

   $query = "SELECT kew,toborow FROM opday WHERE  thdatehn = '$thdatehn' AND vn = '".$_SESSION["nVn"]."' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");

   if(mysql_num_rows($result)){
print "<div align='right'>";
print"<table border='0' width='80%'>";
	print"<tr>

		<td width='70%'><br></td>
		<td width='80%'><br><br><br><br><br><br>";
  while (list ($kew,$toborow) = mysql_fetch_row ($result)) {

print "<HTML>";print "<script>"; print "ie4up=nav4up=false;"; print "var agt = navigator.userAgent.toLowerCase();"; print "var major = parseInt(navigator.appVersion);"; print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   print "ie4up = true;"; print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   print "nav4up = true;";print "</script>";print "<head>";print "<STYLE>"; print "A {text-decoration:none}"; print "A IMG {border-style:none; border-width:0;}"; print "DIV {position:absolute; z-index:25;}";print ".fc1-0 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";print ".fc1-1 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-2 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";print ".fc1-7 { COLOR:000000;FONT-SIZE:40PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";print "</STYLE>";print "<TITLE>Crystal Report Viewer</TITLE>";print "</head>";print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:470PX;top:10PX;width:500PX;height:30PX;'><span class='fc1-1'>�ӴѺ���:</span></DIV>";
print "<DIV style='left:540PX;top:0PX;width:900PX;height:70PX;'><span class='fc1-7'>$kew</span></DIV>";

print "<DIV style='left:430PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$toborow</span></DIV>";
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
