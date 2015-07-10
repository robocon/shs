<body Onload="window.print();">
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(1/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
     session_start();

	

     $Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s")."&nbsp;&nbsp;&nbsp;<span class='fc1-1'> </span>";
	 $Thaidate1=date("dm").(date("Y"));
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

print ".fc1-0 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:18PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-99 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:3 of 9 barcode;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
print "<center><span class='fc1-1'>ใบตรวจโรคผู้ป่วยนัด<br> โรงพยาบาลค่ายสุรศักดิ์มนตรี</span><br></DIV>";
print "<span class='fc1-0'>วันที่&nbsp;$Thaidate</span><br></DIV>";
print "<span class='fc1-2'>VN: $nVn</span></DIV>";
print "<span class='fc1-2'>&nbsp;&nbsp;HN: $cHn</span><br></DIV>";
print "<span class='fc1-1 '>ชื่อ&nbsp;$cPtname</span><br></DIV>";

print "<span class='fc1-0'>อายุ&nbsp;$cAge</span><br></DIV>";
print "<span class='fc1-1'>สิทธิ:&nbsp; $cPtright</span><br></DIV>";



$cIdcard1=substr($cIdcard,0,1);
$cIdcard2=substr($cIdcard,1,4);
$cIdcard3=substr($cIdcard,5,5);
$cIdcard4=substr($cIdcard,10,2);
$cIdcard5=substr($cIdcard,12,1);
$cIdcard9=$cIdcard1."-".$cIdcard2."-".$cIdcard3."-".$cIdcard4."-".$cIdcard5;



print "<span class='fc1-0'>บัตร ปชช: &nbsp; $cIdcard9</span><br></DIV>";
print "<span class='fc1-0'>#.$cIdguard</span>&nbsp;&nbsp;หมายเหตุ&nbsp;<br></DIV>";
print "<span class='fc1-0'>$cNote:</span><br></DIV>";
print "<span class='fc1-2'>*ยื่นรับยาช่องหมายเลข 6*</span><br></DIV>";
//print "<DIV style='left:350PX;top:160PX;width:500PX;height:50PX;'><span class='fc1-99'>01$Thaidate1$nVn</span></DIV>";





//print "<DIV style='left:530PX;top:160PX;width:500PX;height:50PX;'><span class='fc1-99'>$cIdcard</span></DIV>";
//print "<DIV style='left:300PX;top:10PX;width:200PX;height:30PX;'><span class='fc1-99'>$Thaidate</span></DIV>";
//print "<DIV style='left:520PX;top:10PX;width:306PX;height:30PX;'><span class='fc1-0'>$sOfficer..ตรวจสอบสิทธิ</span></DIV>";
print "<span class='fc1-0'><img src = \"printbcpha.php?cHn=$idcard\"></span><br></DIV>";

print "<span class='fc1-0'> แพทย์จ่ายยาผ่านระบบคอม</span><br></DIV>";
 include("connect.inc");  

$query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '".$cHn."' ";
$result = mysql_query($query) or die("Query drugreact failed");
$count =mysql_num_rows($result);
if($count > 0){
	$i=1;
print "<span class='fc1-0'>";
	print "<B>ประวัติการแพ้ยา</B><BR>";
		while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
			print $tradname ;
			print "&nbsp;&nbsp;" ;
			print $advreact;
			
			if($i != $count)
				if($i%3==0) print "<BR>";else print ",&nbsp;";
			$i++;
		}
	print "</span><br><br></DIV>";

}
//แพ้ยา


print "<span class='fc1-0'> แพทย์.......................</span><br></DIV>";
print "</BODY></HTML>";




$sql = "SELECT inrxform FROM opcard WHERE  hn = '".$cHn."' limit 1";
$result = Mysql_Query($sql);
list($note) = Mysql_fetch_row($result);

if($note != ""){
	if($note == "ผู้ป่วยกลุ่มเสี่ยงต้องได้รับการฉีดวัคซีนป้องกันโรคไข้หวัดใหญ่(ฟรี)")
		$note .= "<BR>Influza Vaccine 0.5 ml. IM";
	print "<span class='fc1-0'>".$note."</span><br></DIV>";
	$top_drugreact = "180";
}else{
	$top_drugreact = "130";
}

//แพ้ยา



   $query = "SELECT kew,toborow FROM opday WHERE  thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
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

print ".fc1-0 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:18PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-7 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";


print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:470PX;top:10PX;width:500PX;height:30PX;'><span class='fc1-1'></span></DIV>";
//print "<DIV style='left:540PX;top:0PX;width:900PX;height:70PX;'><span class='fc1-7'>$kew</span></DIV>";

//print "<DIV style='left:430PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$toborow</span></DIV>";




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

print "<font face='Angsana New' size= 2 ><b>LAB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;XRAY</b><BR>";
		
		print "

			<TABLE style='font-size: 16px' border='0' width='200'>
		
			<TR>
						<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD>CXR</TD>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD></TD>
				<TD colspan='4'>PLAIN KUB</TD>
				
			</TR>
				<TR>
				
				<TD colspan='8'><INPUT TYPE=\"checkbox\" NAME=\"\" readonly>L-S SPINE AP, LAT</TD>
				
				
				
			</TR>
			<TR>
				
				<TD colspan='12'><INPUT TYPE=\"checkbox\" NAME=\"\" readonly>ABDOMEN </TD>
			</TR>
			<TR>
				<TD colspan='8' >
				( SUPINE , UPRIGHT )
				</TD>
			</TR>
			<TR>
					<TD colspan='8' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly>
					OTHERS:................................<BR>......................................................
					<BR>........................................................
				</TD>
			</TR>
			
			<TD colspan='12' align='right'>
					แพทย์.................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</TD>
			</TR>
	
			</TABLE>
		";
?>

